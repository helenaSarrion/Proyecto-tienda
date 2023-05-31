<?php

namespace App\Controller;

use App\Entity\Productos;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Categorias;
use App\Entity\Pedidos;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\Entity\Tallas;
use App\Entity\Tamanos;

class CarritoController extends AbstractController
{
    /**
     * @Route("/carrito", name="carrito")
     */
    public function index(SessionInterface $session): Response
    {
        $carrito = $session->get('carrito', []);
        $productos = $this->getDoctrine()->getRepository(Productos::class)->findBy(['codprod' => array_keys($carrito)]);
        $tallas = $this->getDoctrine()->getRepository(Tallas::class)->findAll();
        $tamanos = $this->getDoctrine()->getRepository(Tamanos::class)->findAll();
        $categorias = $this->getDoctrine()->getRepository(Categorias::class)->findAll();

        return $this->render('carrito/index.html.twig', [
            'productos' => $productos,
            'carrito' => $carrito,
            'tallas' => $tallas,
            'tamanos' => $tamanos,
            'categorias' => $categorias,
        ]);
    }

    /**
     * @Route("/carrito/agregar/{codprod}", name="agregar_al_carrito")
     */
    public function agregarAlCarrito($codprod, SessionInterface $session, Request $request): Response
    {
        $carrito = $session->get('carrito', []);
        $carrito[$codprod] = isset($carrito[$codprod]) ? ++$carrito[$codprod] : 1;
        $session->set('carrito', $carrito);

        // Redirecciona a la página actual
        return $this->redirect($request->headers->get('referer'));
    }


    /**
     * @Route("/carrito/quitar/{codprod}", name="quitar_del_carrito")
     */
    public function quitarDelCarrito($codprod, SessionInterface $session): Response
    {
        $carrito = $session->get('carrito', []);
        if (isset($carrito[$codprod])) {
            if ($carrito[$codprod] > 1) {
                $carrito[$codprod]--;
            } else {
                unset($carrito[$codprod]);
            }
        }
        $session->set('carrito', $carrito);

        return $this->redirectToRoute('carrito');
    }

    /**
     * @Route("/carrito/vaciar", name="vaciar_carrito")
     */
    public function vaciarCarrito(SessionInterface $session): Response
    {
        $session->set('carrito', []);

        return $this->redirectToRoute('carrito');
    }

    /**
     * @Route("/carrito/actualizar/{id}", name="actualizar_cantidad", methods={"POST"})
     */
    public function actualizarCantidad($id, SessionInterface $session, Request $request): Response
    {
        $carrito = $session->get('carrito', []);
        $cantidad = (int) $request->request->get('cantidad');

        $entityManager = $this->getDoctrine()->getManager();
        $producto = $entityManager->getRepository(Productos::class)->find($id);

        if (!$producto) {
            throw $this->createNotFoundException('El producto no existe.');
        }

        if ($cantidad <= 0 || $cantidad > $producto->getStock()) {
            $this->addFlash('error', 'Cantidad inválida.');
        } else {
            $carrito[$id] = $cantidad;
            $session->set('carrito', $carrito);
            $this->addFlash('success', 'Cantidad actualizada correctamente.');

            $producto->setStock($producto->getStock() - $cantidad);
            $entityManager->persist($producto);
            $entityManager->flush();
        }

        return $this->redirectToRoute('carrito');
    }


    /**
     * @Route("/carrito/pedido", name="realizar_compra")
     */
    public function realizarCompra(Request $request, SessionInterface $session, EntityManagerInterface $entityManager): Response
    {
        // Obtener los productos del carrito
        $carrito = $session->get('carrito', []);
        $productos = $this->getDoctrine()->getRepository(Productos::class)->findBy(['codprod' => array_keys($carrito)]);

        // Mostrar el formulario de datos del usuario y opciones de pago
        $form = $this->createFormBuilder()
            ->add('nombre', TextType::class, ['label' => 'Nombre'])
            ->add('direccion', TextType::class, ['label' => 'Dirección'])
            ->add('telefono', TextType::class, ['label' => 'Teléfono'])
            ->add('email', EmailType::class, ['label' => 'Email'])
            ->add('metodoPago', ChoiceType::class, [
                'label' => 'Método de pago',
                'choices' => ['Google Pay' => 'google pay', 'PayPal' => 'paypal', 'Apple Pay' => 'apple pay'],
            ])
            ->add('confirmar', SubmitType::class, ['label' => 'Confirmar compra'])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Obtener los datos del formulario
            $datos = $form->getData();

            $total = 0;
            $nombreProductos = [];
            $codProductos = [];
            $cantidadProductos = [];

            $entityManager = $this->getDoctrine()->getManager();

            foreach ($productos as $producto) {
                $cantidad = $carrito[$producto->getCodprod()];
                $producto->setStock($producto->getStock() - $cantidad);
                $total += $producto->getPrecio() * $cantidad;
                $nombreProductos[] = $producto->getNombre();
                $codProductos[] = $producto->getCodprod();
                $cantidadProductos[$producto->getCodprod()] = $cantidad;

                // Crear un nuevo pedido para cada producto
                $pedido = new Pedidos();
                $pedido->setCodusu($this->getUser());
                $pedido->setNombre($datos['nombre']);
                $pedido->setDireccion($datos['direccion']);
                $pedido->setTelefono($datos['telefono']);
                $pedido->setEmail($datos['email']);
                $pedido->setMetodoPago($datos['metodoPago']);
                $pedido->setTotal($producto->getPrecio() * $cantidad);
                $pedido->setEnviado(false);
                $pedido->setFecha(new \DateTime());
                $pedido->setNombreProd($producto->getNombre());
                $pedido->setCodProd($producto->getCodprod());
                $pedido->setCantidad($cantidad);

                if ($producto->getCategoria() == 3) { // Categoría para camisetas
                    $idTalla = $producto->getIdTalla();
                    $talla = $entityManager->getRepository(Tallas::class)->find($idTalla);
                    if ($talla) {
                        $pedido->setTalla($talla->getNombre());
                    }
                } elseif ($producto->getCategoria() == 2) { // Categoría para posters
                    $idTamano = $producto->getIdTamano();
                    $tamano = $entityManager->getRepository(Tamanos::class)->find($idTamano);
                    if ($tamano) {
                        $pedido->setTamano($tamano->getNombre());
                    }
                }

                $entityManager->persist($pedido);
            }

            // Guardar todos los pedidos en la base de datos
            $entityManager->flush();


            // Limpiar el carrito de la sesión
            $session->set('carrito', []);

            // Mostrar la confirmación de compra
            return $this->render('carrito/confirmacion.html.twig');
        }

        // Mostrar el formulario de datos del usuario y opciones de pago
        return $this->render('carrito/pedido.html.twig', [
            'form' => $form->createView(),
            'productos' => $productos,
            'carrito' => $carrito,
        ]);
    }
}
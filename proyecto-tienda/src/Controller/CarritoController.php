<?php
namespace App\Controller;

use App\Entity\Productos;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;


class CarritoController extends AbstractController
{
    /**
     * @Route("/carrito", name="carrito")
     */
    public function index(SessionInterface $session): Response
    {
        $carrito = $session->get('carrito', []);
        $productos = $this->getDoctrine()->getRepository(Productos::class)->findBy(['codprod' => array_keys($carrito)]);

        return $this->render('carrito/index.html.twig', [
            'productos' => $productos,
            'carrito' => $carrito,
        ]);
    }

    /**
     * @Route("/carrito/agregar/{codprod}", name="agregar_al_carrito")
     */
    public function agregarAlCarrito($codprod, SessionInterface $session): Response
    {
        $carrito = $session->get('carrito', []);
        if (!isset($carrito[$codprod])) {
            $carrito[$codprod] = 0;
        }
        $carrito[$codprod]++;
        $session->set('carrito', $carrito);

        return $this->redirectToRoute('carrito');
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
        $producto = $this->getDoctrine()->getRepository(Productos::class)->find($id);

        if (!$producto) {
            throw $this->createNotFoundException('El producto no existe.');
        }

        if ($cantidad <= 0 || $cantidad > $producto->getStock()) {
            $this->addFlash('error', 'Cantidad inválida.');
        } else {
            $carrito[$id] = $cantidad;
            $session->set('carrito', $carrito);
            $this->addFlash('success', 'Cantidad actualizada correctamente.');
        }

        return $this->redirectToRoute('carrito');
    }

}
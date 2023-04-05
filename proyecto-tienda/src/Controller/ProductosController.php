<?php

namespace App\Controller;

use App\Entity\Productos;
use App\Repository\ProductosRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Categorias;
use Doctrine\ORM\Query;
use App\RepositoryProductosRepository;

class ProductosController extends AbstractController
{
    /**
     * @Route("/productos", name="productos")
     */
    public function productos(Request $request, EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Productos::class);
        $queryBuilder = $repository->createQueryBuilder('p');
        $categorias = $this->getDoctrine()
            ->getRepository(Categorias::class)
            ->findAll();

        // Obtener los productos filtrados por precio
        $precio = $request->query->get('precio');
        if ($precio) {
            switch ($precio) {
                case 'todos':
                    $queryBuilder->andWhere('p.precio > 0');
                    break;
                case '0-50':
                    $queryBuilder->andWhere('p.precio <= 50');
                    break;
                case '50-100':
                    $queryBuilder->andWhere('p.precio > 50 AND p.precio <= 100');
                    break;
                case '100-200':
                    $queryBuilder->andWhere('p.precio > 100 AND p.precio <= 200');
                    break;
                case '200+':
                    $queryBuilder->andWhere('p.precio > 200');
                    break;
            }
        }

        // Obtener los productos
        $productos = $queryBuilder->getQuery()->getResult();

        return $this->render('productos/index.html.twig', [
            'productos' => $productos,
            'categorias' => $categorias,
        ]);
    }


    public function productosPorCategoria(Request $request, $categoria)
    {
        // Obtener los productos de la categoría seleccionada
        $em = $this->getDoctrine()->getManager();
        $productos = $em->getRepository(Productos::class)->findByCategoria($categoria);

        // Obtener todas las categorías para el menú desplegable
        $categorias = $em->getRepository(Categorias::class)->findAll();

        return $this->render('productos/index.html.twig', [
            'productos' => $productos,
            'categorias' => $categorias,
        ]);
    }


    private function productosPorPrecio($min, $max)
    {
        $em = $this->getDoctrine()->getManager();
        $queryBuilder = $em->getRepository(Productos::class)->createQueryBuilder('p');
        $queryBuilder
            ->where('p.precio >= :min')
            ->andWhere('p.precio <= :max')
            ->setParameter('min', $min)
            ->setParameter('max', $max);
        $query = $queryBuilder->getQuery();

        return $query->getResult();
    }

    
    public function buscarPorNombre(Request $request)
    {
        $nombre = $request->query->get('nombre');
        // Obtener los productos que coincidan con el nombre
        $em = $this->getDoctrine()->getManager();
        $productos = $em->getRepository(Productos::class)->createQueryBuilder('p')
            ->where('p.nombre LIKE :nombre')
            ->setParameter('nombre', '%' . $nombre . '%')
            ->getQuery()
            ->getResult();

        // Renderizar la vista correspondiente con los productos encontrados
        return $this->render('productos/buscar.html.twig', [
            'productos' => $productos,
        ]);


    }


    public function show(Request $request, $codprod): Response
    {
        $em = $this->getDoctrine()->getManager();
        $producto = $em->getRepository(Productos::class)->find($codprod);

        return $this->render('productos/detalles.html.twig', [
            'producto' => $producto,
        ]);
    }
}
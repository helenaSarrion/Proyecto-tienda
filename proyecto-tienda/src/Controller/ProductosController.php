<?php

namespace App\Controller;

use App\Entity\Productos;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductosController extends AbstractController
{
    /**
     * @Route("/productos", name="productos")
     */
    public function productos(Request $request, EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Productos::class);
        $queryBuilder = $repository->createQueryBuilder('p');

        // Obtener los productos filtrados por precio
        $precio = $request->query->get('precio');
        if ($precio) {
            switch ($precio) {
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
        ]);
    }



    public function productosPorCategoria(Request $request, $categoria)
    {
        $em = $this->getDoctrine()->getManager();
        $productos = $em->getRepository(Productos::class)->findByCategoria($categoria);

        return $this->render('productos/index.html.twig', [
            'productos' => $productos,
            'categoria' => $categoria,
        ]);
    }

    private function findByPrecio($min, $max)
    {
        return $this->getDoctrine()
            ->getRepository(Productos::class)
            ->createQueryBuilder('p')
            ->andWhere('p.precio >= :min')
            ->andWhere('p.precio <= :max')
            ->setParameter('min', $min)
            ->setParameter('max', $max)
            ->getQuery()
            ->getResult();
    }

}
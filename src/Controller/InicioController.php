<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Categorias;
use App\Entity\Productos;
use Doctrine\ORM\EntityManagerInterface;

class InicioController extends AbstractController
{
    /**
     * @Route("/", name="inicio")
     * Funcion que mostrara la pagina de inicio de la tienda 
     */
    public function index(EntityManagerInterface $em): Response
    {
        $productosRecientes = $em->getRepository(Productos::class)->findBy([], ['fecha_creacion' => 'DESC'], 5);
        $categorias = $this->getDoctrine()
            ->getRepository(Categorias::class)
            ->findAll();

        return $this->render('inicio/index.html.twig', [
            'controller_name' => 'InicioController',
            'categorias' => $categorias,
            'productosRecientes' => $productosRecientes, // Productos recientes añadidos a la tienda
        ]);

    }
}
<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Categorias;


class InicioController extends AbstractController
{
    /**
     * @Route("/", name="inicio")
     */
    public function index(): Response
    {
        $categorias = $this->getDoctrine()
            ->getRepository(Categorias::class)
            ->findAll();

        return $this->render('inicio/index.html.twig', [
            'controller_name' => 'InicioController',
            'categorias' => $categorias,
        ]);

    }
}
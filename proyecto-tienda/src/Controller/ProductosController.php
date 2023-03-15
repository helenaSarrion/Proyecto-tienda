<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Productos;

class ProductosController extends AbstractController
{

    /**
     * @Route("/productos", name="productos")
     */
    public function productos(Request $request): Response
    {
        $productos = $this->getDoctrine()->getRepository(Productos::class)->findAll();
        foreach ($productos as $producto) {
            dump($producto->getImageLink());
        }

        return $this->render('productos/index.html.twig', [
            'productos' => $productos,
        ]);
    }

}
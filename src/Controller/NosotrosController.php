<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Categorias;

class NosotrosController extends AbstractController
{
    /**
     * @Route("/nosotros", name="nosotros")
     * Funcion que mostrara la pagina de nosotros de la tienda, donde se mostrara informacion sobre los productos 
     * que se venden.
     */
    public function nosotros(Request $request): Response
    {
        $categorias = $this->getDoctrine()
            ->getRepository(Categorias::class)
            ->findAll();
        return $this->render('nosotros/index.html.twig', [
            'controller_name' => 'NosotrosController',
            'categorias' => $categorias,
        ]);
    }

}
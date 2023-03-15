<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class NosotrosController extends AbstractController
{

    /**
     * @Route("/nosotros", name="nosotros")
     */
    public function nosotros(Request $request): Response
    {
        return $this->render('nosotros/index.html.twig', [
            'controller_name' => 'NosotrosController',
        ]);
    }

}

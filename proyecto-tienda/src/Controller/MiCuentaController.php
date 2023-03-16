<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MiCuentaController extends AbstractController
{
    /**
     * @Route("/mi-cuenta", name="mi_cuenta")
     */
    public function index()
    {
        $user = $this->getUser();

        return $this->render('mi_cuenta/index.html.twig', [
            'user' => $user,
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class LogoutController extends AbstractController
{

    /**
     * @Route("/logout", name="logout")
     */
    public function logout(Request $request): Response{
        $this->get('security.token_storage')->setToken(null);
        $this->get('session')->invalidate();
        return $this->redirectToRoute('inicio');
    }
}
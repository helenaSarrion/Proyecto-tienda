<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Form\UserType;



class UserController extends AbstractController
{
    /**
     * @Route("/perfil", name="verPerfil")
     */
    public function verPerfil(): Response
    {
        $usuario = $this->getUser();

        return $this->render('user/index.html.twig', [
            'nombre' => $usuario->getNombre(),
            'email' => $usuario->getEmail(),
        ]);
    }

    /**
     * @Route("/perfil/editar", name="editarPerfil")
     
    public function editarPerfil(Request $request, EntityManagerInterface $entityManager): Response
    {
        $usuario = $this->getUser();

        $form = $this->createForm(UserType::class, $usuario);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($usuario);
            $entityManager->flush();

            return $this->redirectToRoute('verPerfil');
        }

        return $this->render('user/editar.html.twig', [
            'form' => $form->createView(),
            'nombre' => $usuario->getNombre(),
            'email' => $usuario->getEmail(),

        ]);
    }
    */

}
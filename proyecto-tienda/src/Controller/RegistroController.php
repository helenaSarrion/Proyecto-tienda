<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistroController extends AbstractController
{

    /**
     * @Route("/registro", name="registro")
     */
    public function registro(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        $email = $request->request->get('email');
        $password = $request->request->get('password');

        if ($email !== null) {
            $user = new User();
            $user->setEmail($email);
            $user->setPassword($passwordEncoder->encodePassword($user, $password));

            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('inicio');
        }

        return $this->render('registro/index.html.twig');
    }

}
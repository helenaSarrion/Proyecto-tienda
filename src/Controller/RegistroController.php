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
     * Funcion que sirve para hacer el registro de un usuario
     */
    public function registro(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $entityManager = $this->getDoctrine()->getManager();

        //Datos a insertar en la base de datos
        $nombre = $request->request->get('nombre');
        $email = $request->request->get('email');
        $password = $request->request->get('password');

        //Comprobar que el email no este registrado en la base de datos 
        if ($email !== null) {
            $user = new User();
            $user->setRoles(['ROLE_USER']);
            $user->setEmail($email);
            $user->setNombre($nombre);
            $user->setPassword($passwordEncoder->encodePassword($user, $password));

            //Guardamos los datos en la base de datos 
            $entityManager->persist($user);
            $entityManager->flush();

            //Redireccionamos a la pagina de inicio
            return $this->redirectToRoute('inicio');
        }

        return $this->render('registro/index.html.twig');
    }

}

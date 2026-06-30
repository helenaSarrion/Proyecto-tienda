<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;



class UserController extends AbstractController
{
    /**
     * @Route("/perfil", name="verPerfil")
     * Funcion en la que el usuario podra ver su perfil con sus datos personales
     */
    public function verPerfil(): Response
    {
        $usuario = $this->getUser();

        return $this->render('user/index.html.twig', [
            'nombre' => $usuario->getNombre(),
            'email' => $usuario->getEmail(),
            'password' => $usuario->getPassword(),
        ]);
    }


    /**
     * @Route("/cambiar-contrasena", name="cambiar_contrasena", methods={"POST"})
     * Funcion en la que el usuario podra cambiar su contraseña, para ello tendra que introducir la nueva contraseña dos veces
     * y si las dos contraseñas coinciden se cambiara la contraseña
     */
    public function cambiarContrasena(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $password = $request->request->get('password');
        $password2 = $request->request->get('password2');

        // Validar que las contraseñas coincidan
        if ($password !== $password2) {
            $this->addFlash('error', 'Las contraseñas no coinciden');
            return $this->redirectToRoute('user/index.html.twig');
        }

        // Obtiene el usuario actual
        $usuario = $this->getUser();

        // Codificar la nueva contraseña
        $nuevaContrasena = $passwordEncoder->encodePassword($usuario, $password);

        // Actualizar la contraseña del usuario en la base de datos 
        $usuario->setPassword($nuevaContrasena);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        $this->addFlash('success', 'La contraseña se ha cambiado exitosamente');

        return $this->redirectToRoute('verPerfil');
    }

}
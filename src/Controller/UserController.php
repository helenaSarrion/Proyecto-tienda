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

        // Obtener el usuario actualmente autenticado
        $usuario = $this->getUser();

        // Codificar la nueva contraseña
        $nuevaContrasena = $passwordEncoder->encodePassword($usuario, $password);

        // Actualizar la contraseña del usuario
        $usuario->setPassword($nuevaContrasena);
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();

        $this->addFlash('success', 'La contraseña se ha cambiado exitosamente');

        return $this->redirectToRoute('verPerfil'); 
    }

}
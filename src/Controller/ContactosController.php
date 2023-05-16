<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class ContactosController extends AbstractController
{
    /**
     * @Route("/contactos", name="contactos")
     */
    public function index(Request $request, MailerInterface $mailer): Response
    {
        $form = $this->createFormBuilder()
            ->add('email')
            ->add('subject')
            ->add('message')
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $email = (new Email())
                ->from($data['email'])
                ->to('contact@example.com')
                ->subject($data['subject'])
                ->text($data['message']);

            $mailer->send($email);

            $this->addFlash('success', 'Gracias por contactarnos. Responderemos su mensaje lo antes posible.');

            return $this->redirectToRoute('contactos');
        }

        return $this->render('contactos/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="app_contact")
     */
    public function index(Request $request, MailerInterface $mailer)
    {
        $form = $this->createForm(ContactType::class);
        //process form data
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $contact = $form->getData();
            // ici on crée le mail


            $email = (new TemplatedEmail())
                // email address as a simple string
                ->from($contact['email'])
                ->to('contact@nakamalist.fr')
                ->text($contact['message'])
                ->subject('Nouveau message !')
                ->htmlTemplate('emails/contact.html.twig')
                ->context([
                    'nom' => $contact['email'],
                    'mail' => $contact['email'],
                    'message' =>$contact['message']
                ])
            ;
            // ici on envoie le mail
                $mailer->send($email);

                $this->addFlash('message', 'votre e-mail a bien été envoyé');
                    return $this->redirectToRoute('app_contact');

        }
        return $this->render('contact/index.html.twig', [
            'contactForm' => $form->createView(),
        ]);
    }
}

<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Service\MessageGeneratorInterface;
use App\Service\SentMessageServiceInterface;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     */
    public function contact(
        Request $request,
        LoggerInterface $logger,
        EntityManagerInterface $entityManager,
        MessageGeneratorInterface $messageGenerator,
        SentMessageServiceInterface $messageService
    )
    {
        $this->addFlash('info', $messageGenerator->getHappyMessage());

        $contact = new Contact();
        $contact->setTitle('Please enter title of your message here');
        $contact->setName('Please enter your name here');
        $contact->setemail('Please enter your email here');
        $contact->setMessage('Please your message here');

        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $contact = $form->getData();
            $entityManager->persist($contact);
            $entityManager->flush();
            $logger->info('Message sent: ' . $contact->getTitle());
            //$this->addFlash('success', 'Your message was sent successfully. Thank you for your message!');
            $this->addFlash('success', $messageService->messageNotify($contact));
            return $this->redirectToRoute('home');
        }

        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

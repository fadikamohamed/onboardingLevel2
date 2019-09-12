<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use App\Notification\ContactNotification;
use Doctrine\Common\Persistence\ObjectManager;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;


class ContactController extends AbstractFOSRestController
{

    /**
     * @Rest\Get("/contactList")
     */
    public function ContactList()
    {
        $repo = $this->getDoctrine()->getRepository(Contact::class);
        $contacts = $repo->findAll();
        return $this->handleView($this->view($contacts));
    }


    /**
     * @Rest\Post("/contactForm")
     */
    public function Contact(Request $request, ContactNotification $notification, ObjectManager $manager)
    {

        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $data = json_decode($request->getContent(), true);
        $form->submit($data);
        if ($form->isSubmitted() && $form->isValid()){
            $notification->notify($contact);
            $notification->response($contact);
            $manager->persist($contact);
            $manager->flush();
            return $this->handleView($this->view(['status' => 'ok'], Response::HTTP_CREATED));
        }

        return $this->handleView($this->view($form->getErrors()));

    }
}

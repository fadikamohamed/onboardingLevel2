<?php
namespace App\Notification;

use App\Entity\Contact;
use Twig\Environment;

class ContactNotification {

    public function __construct(\Swift_Mailer $mailer, Environment $renderer)
    {
        $this->renderer = $renderer;
        $this->mailer = $mailer;
    }

    public function notify(Contact $contact)
    {
        $message = (new \Swift_Message('Département : ' . $contact->getDivision()->getLabel()))
            ->setFrom($contact->getMail())
            ->setTo($contact->getDivision()->getMail())
            ->setReplyTo($contact->getMail())
            ->setBody($this->renderer->render('email/contact.html.twig', [
                'contact' => $contact
            ]), 'text/html');
        $this->mailer->send($message);
    }

}
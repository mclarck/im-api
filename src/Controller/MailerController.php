<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Address;
use Psr\Log\LoggerAwareInterface;

class MailerController extends AbstractController implements LoggerAwareInterface
{

    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @Route("/smail")
     */
    public function swiftEmail(\Swift_Mailer $mailer)
    {
      
        $message = (new \Swift_Message('New Order'))
            ->setFrom('noreply@inmarketify.ml')
            ->setTo('contact.mclarck@gmail.com')
            ->setBody('New order processed!');

        try {
            $mailer->send($message);
            return $this->json(["message" => "email sent"]);
        } catch (\Throwable $th) {
            return $this->json(["error" => $th->getMessage()]);
        }
    }
    /**
     * @Route("/mail")
     */
    public function sendEmail(
        MailerInterface $mailer,
        LoggerInterface $log
    ) {
        $this->logger->info("teest logger");
        $email = (new TemplatedEmail())
            ->from(new Address('noreply@inmarketify.ml', 'InMarketify'))
            ->to('contact.mclarck@gmail.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            ->priority(Email::PRIORITY_HIGH)
            // ->attachFromPath('/path/to/documents/terms-of-use.pdf')
            // // optionally you can tell email clients to display a custom name for the file
            // ->attachFromPath('/path/to/documents/privacy.pdf', 'Privacy Policy')
            // // optionally you can provide an explicit MIME type (otherwise it's guessed)
            // ->attachFromPath('/path/to/documents/contract.doc', 'Contract', 'application/msword')
            // get the image contents from a PHP resource
            // ->embed(fopen('/path/to/images/logo.png', 'r'), 'logo')
            // // get the image contents from an existing file
            // ->embedFromPath('/path/to/images/signature.gif', 'footer-signature')
            // ->embed(fopen('/path/to/images/logo.png', 'r'), 'logo')
            // ->embedFromPath('/path/to/images/signature.gif', 'footer-signature')
            // // reference images using the syntax 'cid:' + "image embed name"
            // ->html('<img src="cid:logo"> ... <img src="cid:footer-signature"> ...')
            // $email = (new TemplatedEmail())
            // path of the Twig template to render
            ->htmlTemplate('emails/neworder.html.twig')
            // // pass variables (name => value) to the template
            ->context([
                'expiration_date' => new \DateTime('+7 days'),
                'username' => 'foo',
            ])


            ->subject('New Order!')
            ->text('We have a new order!')
            // ->html('<p>See Twig integration for better HTML integration!</p>')
        ;
        try {
            $mailer->send($email);
            return $this->json(["message" => "email sent"]);
        } catch (\Throwable $th) {
            return $this->json(["error" => $th->getMessage()]);
        }
    }
}

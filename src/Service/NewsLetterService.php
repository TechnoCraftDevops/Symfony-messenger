<?php
namespace App\Service;

use App\Entity\NewsLetter;
use App\Entity\User;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;

class NewsLetterService
{
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }

    public function send(User $user, NewsLetter $newsletter):void
    {
        // throw new \Exception('Message non envoyé');
        $email = (new TemplatedEmail())
            ->from('newsletter@app.fr')
            ->to($user->getEmail())
            ->subject($newsletter->getName())
            ->text($newsletter->getContent())
            ->context(compact('newsletter', 'user'))
        ;
        $this->mailer->send($email);
    }
}
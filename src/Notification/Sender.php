<?php

namespace App\Notification;

use App\Entity\User;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Security\Core\User\UserInterface;

class Sender
{
    protected $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;
    }
    public function SendNewUserNotificationToAdmin(UserInterface $user)
    {
        //for test
        //file_put_contents('debug.text', $user->getEmail());
        $message = new Email();
        $message->from('account@series.com')
            ->to('admin@series.com')
            ->subject('new acount created on series.com')
            ->html('<h1>new account </h1> email : ' . $user->getEmail());
//dd($message);
        $this->mailer->send($message);
    }
}
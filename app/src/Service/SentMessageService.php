<?php
/**
 * Created by PhpStorm.
 * User: sergii
 * Date: 07.03.18
 * Time: 12:40
 */

namespace App\Service;


class SentMessageService implements SentMessageServiceInterface
{
    private $messageGenerator;
    private $mailer;
    private $adminEmail;

    public function __construct(
        MessageGeneratorInterface $messageGenerator,
        \Swift_Mailer $mailer,
        $adminEmail
    )
    {
        $this->messageGenerator = $messageGenerator;
        $this->mailer = $mailer;
        $this->adminEmail = $adminEmail;
    }

    public function messageNotify($comment)
    {
        //$happyMessage = $this->messageGenerator->getHappyMessage();
        $happyMessage = 'Дякуємо за ваше повідомлення!';

        $adminMessage = (new \Swift_Message('New message was sent'))
            ->setFrom('s.zazymko@gmail.com')
            ->setTo($this->adminEmail)
            ->setBody('Somebody sent a message: ' . $comment, 'text/plain');

        $this->mailer->send($adminMessage);

        return $happyMessage;
    }
}
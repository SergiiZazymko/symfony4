<?php
/**
 * Created by PhpStorm.
 * User: sergii
 * Date: 07.03.18
 * Time: 11:59
 */

namespace App\Service;


use App\Repository\HappyMessageRepository;

class MessageGenerator implements MessageGeneratorInterface
{
    private $repository;

    public function __construct(HappyMessageRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getHappyMessage()
    {
        $happyMessages = $this->repository->findAll();
        $happyMessage = $happyMessages[array_rand($happyMessages)];
        return $happyMessage;
    }
}
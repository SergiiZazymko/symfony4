<?php
/**
 * Created by PhpStorm.
 * User: sergii
 * Date: 07.03.18
 * Time: 12:25
 */

namespace App\Service;


use App\Repository\HappyMessageRepository;

interface MessageGeneratorInterface
{
    public function __construct(HappyMessageRepository $repository);
    public function getHappyMessage();
}
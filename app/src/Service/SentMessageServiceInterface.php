<?php
/**
 * Created by PhpStorm.
 * User: sergii
 * Date: 07.03.18
 * Time: 13:08
 */

namespace App\Service;


interface SentMessageServiceInterface
{
    public function messageNotify($comment);
}
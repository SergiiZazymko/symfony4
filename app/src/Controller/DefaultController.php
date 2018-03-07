<?php
/**
 * Created by PhpStorm.
 * User: sergii
 * Date: 07.03.18
 * Time: 17:58
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/adminka")
     */
    public function admin()
    {
        return new Response('<html><body>Admin page!</body></html>');
    }
}
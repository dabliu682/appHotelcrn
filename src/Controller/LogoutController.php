<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LogoutController extends AbstractController
{
    public function index(): Response
    {
        return $this->render('logout/index.html.twig', ['controller_name' => 'LogoutController']);
    }
}

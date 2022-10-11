<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/test/{classe}', name: 'app_test')]
    public function index($classe): Response
    {
        return $this->render('test/index.html.twig', [
            'controller_name' => $classe,
        ]);
    }
}

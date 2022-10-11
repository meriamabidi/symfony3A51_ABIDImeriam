<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClubbController extends AbstractController
{
    #[Route('/clubb', name: 'app_clubb')]
    public function index(): Response
    {
        $clubs = [
            ["name" => "AIESEC", "inscriptionDate" => "09/09/2022", "openSpots" => '50'],
            ["name" => "ENACTUS", "inscriptionDate" => "30/09/2022", "openSpots" => '0'],
            ["name" => "AUTO CLUB", "inscriptionDate" => "12/09/2022", "openSpots" => '30']
        ];
        return $this->render('clubb/index.html.twig', [
            'controller_name' => 'ClubController', 'clubs' => $clubs
        ]);
    }
}

<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EcrituresController extends AbstractController
{
    #[Route('/ecritures', name: 'app_ecritures')]
    public function index(): Response
    {
        return $this->render('ecritures/index.html.twig', [
            'controller_name' => 'EcrituresController',
        ]);
    }



}

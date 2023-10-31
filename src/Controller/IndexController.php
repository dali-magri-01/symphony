<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class IndexController extends AbstractController
{
    #[Route('/', name: 'index_home')]
    #[IsGranted('ROLE_USER')]
    public function home()
    {
        return $this->render('index.html.twig');
    }
}
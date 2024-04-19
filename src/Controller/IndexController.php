<?php

namespace App\Controller;

use App\Repository\MenuRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use App\Entity\Menu;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



class IndexController extends AbstractController
{
    #[Route('/', name: 'index_home')]
    #[IsGranted('ROLE_USER')]
    public function home()
    {
        return $this->render('index.html.twig');
    }




//    #[Route('/', name: 'index_home')]
//    public function index(MenuRepository $menuRepository): Response
//    {
//        $menusparent = $menuRepository->findByParentIdIsNull();
//        $menusfils = $menuRepository->findByParentIdIsNotNull();
//        return $this->render('base.html.twig', [
//            'menusparents' => $menusparent,
//            'menusfils' => $menusfils,
//
//        ]);
//    }


}

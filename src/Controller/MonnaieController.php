<?php

namespace App\Controller;

use App\Entity\Monnaie;
use App\Form\MonnaieType;
use App\Repository\MonnaieRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/monnaie')]
class MonnaieController extends AbstractController
{
    #[Route('/', name: 'app_monnaie_index', methods: ['GET'])]
    public function index(MonnaieRepository $monnaieRepository): Response
    {
        return $this->render('monnaie/index.html.twig', [
            'monnaies' => $monnaieRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_monnaie_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $monnaie = new Monnaie();
        $form = $this->createForm(MonnaieType::class, $monnaie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($monnaie);
            $entityManager->flush();

            return $this->redirectToRoute('app_monnaie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('monnaie/new.html.twig', [
            'monnaie' => $monnaie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_monnaie_show', methods: ['GET'])]
    public function show(Monnaie $monnaie): Response
    {
        return $this->render('monnaie/show.html.twig', [
            'monnaie' => $monnaie,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_monnaie_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Monnaie $monnaie, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(MonnaieType::class, $monnaie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_monnaie_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('monnaie/edit.html.twig', [
            'monnaie' => $monnaie,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_monnaie_delete', methods: ['POST'])]
    public function delete(Request $request, Monnaie $monnaie, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$monnaie->getId(), $request->request->get('_token'))) {
            $entityManager->remove($monnaie);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_monnaie_index', [], Response::HTTP_SEE_OTHER);
    }
}

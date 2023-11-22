<?php

namespace App\Controller;

use App\Entity\Tiers;
use App\Form\TiersType;
use App\Repository\TiersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tiers')]
class TiersController extends AbstractController
{
    #[Route('/', name: 'app_tiers_index', methods: ['GET'])]
    public function index(TiersRepository $tiersRepository): Response
    {
        return $this->render('tiers/index.html.twig', [
            'tiers' => $tiersRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_tiers_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $tier = new Tiers();
        $form = $this->createForm(TiersType::class, $tier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($tier);
            $entityManager->flush();

            return $this->redirectToRoute('app_tiers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tiers/new.html.twig', [
            'tier' => $tier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tiers_show', methods: ['GET'])]
    public function show(Tiers $tier): Response
    {
        return $this->render('tiers/show.html.twig', [
            'tier' => $tier,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tiers_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tiers $tier, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TiersType::class, $tier);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_tiers_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tiers/edit.html.twig', [
            'tier' => $tier,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tiers_delete', methods: ['POST'])]
    public function delete(Request $request, Tiers $tier, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tier->getId(), $request->request->get('_token'))) {
            $entityManager->remove($tier);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_tiers_index', [], Response::HTTP_SEE_OTHER);
    }
}

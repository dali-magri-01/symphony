<?php

namespace App\Controller;

use App\Entity\Societe;
use App\Form\SocieteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

class SocieteController extends AbstractController
{
    #[Route('/societe', name: 'app_societe')]
    public function index(): Response
    {
        return $this->render('societe/societe-add.html.twig', [
            'controller_name' => 'SocieteController',
        ]);
    }

    #[ Route('/societe-list', name: 'societe_list') ]
    public function ListSociete(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Societe::class);

        $societe = $repository->findAll();
        return $this->render('societe/societe-list.html.twig', [
            'societes' => $societe,
            'controller_name' => 'SocieteController',
        ]);
    }

    #[Route('/add-societe', name: 'app_add_societe')] // Nom de route différent
    public function AddSociete(Request $request, ManagerRegistry $doctrine): Response
    {
        $societe = new Societe();
        $form = $this->createForm(SocieteType::class, $societe);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $doctrine->getManager();
            $entityManager->persist($societe);
            $entityManager->flush();

            // Redirigez l'utilisateur vers une autre page ou affichez un message de succès.
            return $this->redirectToRoute('societe_list');
        }

        return $this->render('societe/societe-add.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    #[Route('/societe/delete/{id}', name: 'societe.delete') ]
    public function deleteSociete(Societe $societe = null, ManagerRegistry $doctrine)
    {
        if ($societe) {
            $manager = $doctrine->getManager();
            //ajouter la fonction de supp dans la transaction
            $manager->remove($societe);
            //Execution transaction
            $manager->flush();
            $this->addFlash('success', "La Societe a ete supprimé avec succe");
        } else {
            $this->addFlash('error', "Societe innexistante");
        }
        return $this->redirectToRoute('societe_list');

    }


    #[Route('/societe/edit/{id?0}', name: 'societe.edit')]
    public function editpersonne(Societe $societe= null, ManagerRegistry $doctrine, Request $request): Response
    {
        $new= false;
        $message="a été mis ajour avec succès";
        $form = $this->createForm(SocieteType::class, $societe);
        $form->remove('createAt');
        $form->remove('updateAt');
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $doctrine->getManager();
            $manager->persist($societe);
            $manager->flush();
            $this->addFlash('success', $societe->getLibelle().$message);
            return $this->redirectToRoute('societe_list');
        } else {
            return $this->render('societe/societe-add.html.twig', [
                'form' => $form->createView(),
            ]);

        }

    }
}

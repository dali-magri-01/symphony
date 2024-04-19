<?php

namespace App\Controller;

use App\Entity\Societe;
use App\Form\SocieteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\String\Slugger\SluggerInterface;



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
//
            $entityManager->persist($societe);
            $entityManager->flush();

            // Redirigez l'utilisateur vers une autre page ou affichez un message de succès.
            return $this->redirectToRoute('societe_list');
        }
        $filename = $societe->getLogoFilename();
        $filePath = '/uploads/Societe/'.$filename;
        return $this->render('societe/societe-add.html.twig', [
            'form' => $form->createView(),
            'fileExists' => $filename,
            'filePath' => $filePath,
            'societe' =>null

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
    public function editpersonne(Societe $societe = null, ManagerRegistry $doctrine, Request $request, SluggerInterface $slugger): Response
    {
        $message = "a été mis à jour avec succès";
        $form = $this->createForm(SocieteType::class, $societe);
        $form->remove('createAt');
        $form->remove('updateAt');
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager = $doctrine->getManager();
            $brochureFile = $form['Filename']->getData();

            // Check if a new file is uploaded
            if ($brochureFile) {
                $originalFilename = pathinfo($brochureFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $brochureFile->guessExtension();

                try {
                    $brochureFile->move(
                        $this->getParameter('brochures_directory'),
                        $newFilename
                    );

                    $societe->setLogoFilename($newFilename);
                } catch (FileException $e) {
                    // Handle the exception if needed
                }
            }

            $manager->persist($societe);
            $manager->flush();

            $this->addFlash('success', $societe->getLibelle() . $message);

            return $this->redirectToRoute('societe_list', ['id' => $societe->getId()]);
        }

        // Handle the case when the form is not submitted or is not valid
        return $this->render('societe/societe-add.html.twig', [
            'form' => $form->createView(),
            'societe' => $societe,
            'fileExists' => $societe->getLogoFilename(),
            'filePath' => '/uploads/Societe/' . $societe->getLogoFilename(),
        ]);
    }
}

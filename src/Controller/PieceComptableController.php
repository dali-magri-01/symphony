<?php

namespace App\Controller;

use App\Entity\PieceComptable;
use App\Form\PieceComptableType;
use App\Repository\JournalRepository;
use App\Repository\PieceComptableRepository;
use App\Repository\TiersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/piece/comptable')]
class PieceComptableController extends AbstractController
{
    #[Route('/', name: 'app_piece_comptable_index', methods: ['GET'])]
    public function index(PieceComptableRepository $pieceComptableRepository,JournalRepository $journalRepository): Response
    {
        $journals = $journalRepository->findAll(); // Ou toute autre méthode pour récupérer les journaux

        return $this->render('piece_comptable/index.html.twig', [
            'piece_comptables' => $pieceComptableRepository->findAll(),
            'journals' => $journals,

        ]);
    }

    #[Route('/new', name: 'app_piece_comptable_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $pieceComptable = new PieceComptable();
        $form = $this->createForm(PieceComptableType::class, $pieceComptable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($pieceComptable);
            $entityManager->flush();

            return $this->redirectToRoute('app_piece_comptable_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('piece_comptable/new.html.twig', [
            'piece_comptable' => $pieceComptable,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_piece_comptable_show', methods: ['GET'])]
    public function show(PieceComptable $pieceComptable): Response
    {
        return $this->render('piece_comptable/show.html.twig', [
            'piece_comptable' => $pieceComptable,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_piece_comptable_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, PieceComptable $pieceComptable, EntityManagerInterface $entityManager): Response
    {
//        dd($entityManager
//            ->createQuery('SELECT pc.id, pc.libelle
//            FROM App\Entity\PieceComptable pc
//            WHERE pc.numero_pc = :numeroPc')
//            ->setParameter('numeroPc', '0200001')
//            ->getResult());

        $form = $this->createForm(PieceComptableType::class, $pieceComptable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_piece_comptable_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('piece_comptable/edit.html.twig', [
            'piece_comptable' => $pieceComptable,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_piece_comptable_delete', methods: ['POST'])]
    public function delete(Request $request, PieceComptable $pieceComptable, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pieceComptable->getId(), $request->request->get('_token'))) {
            $entityManager->remove($pieceComptable);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_piece_comptable_index', [], Response::HTTP_SEE_OTHER);
    }



    #[Route('/getTiersForAccount/', name: 'getTiersForAccount', methods: ['POST'])]
    public function getTiersForAccount(Request $request, TiersRepository $tierRepository): JsonResponse
    {
        // Récupérer les données JSON envoyées dans le corps de la requête
        $jsonData = json_decode($request->getContent(), true);

        // Vérifier si le champ account_id est présent dans les données JSON
        if (!isset($jsonData['account_id'])) {
            // Retourner une erreur si le champ account_id est manquant
            return new JsonResponse(['error' => 'Missing account_id field'], JsonResponse::HTTP_BAD_REQUEST);
        }

        // Récupérer l'ID du compte à partir des données JSON
        $accountId = $jsonData['account_id'];

        // Récupérer les tiers associés à l'ID du compte spécifié
        $tiers = $tierRepository->findTiersByAccountId($accountId);

        // Convertir les données en format JSON
        $data = [];
        foreach ($tiers as $tier) {
            $data[] = [
                'id' => $tier->getId(),
                'name' => $tier->getLibelleTier(), // Assurez-vous d'adapter cela à votre propre entité Tier
            ];
        }

        // Retourner les données JSON
        return new JsonResponse($data);
    }

    #[Route('/getMonnaieForJournal/', name: 'get_monnaie_for_journal', methods: ['POST'])]
    public function getMonnaieForJournal(Request $request, JournalRepository $journalRepository): JsonResponse
        {
            $data = json_decode($request->getContent(), true);
            $journalId = $data['journal'];

            // Fetch monnaie ID for the given journal ID from your repository
            $monnaieId = $journalRepository->getMonnaieIdByJournalId($journalId);

            // You can return the monnaie ID as a JSON response
            return $this->json(['monnaie' => $monnaieId]);
        }

    #[Route('/searchpiececomptable/', name: 'searchpiececomptable', methods: ['POST'])]
    public function searchpiececomptable(Request $request, PieceComptableRepository $piececomptablerepository): JsonResponse
    {
        // Récupérer les paramètres de la requête AJAX
        $jsonData = json_decode($request->getContent(), true);
        $fromDate = $jsonData['fromDate'];
        $toDate = $jsonData['toDate'];
        $journal = $jsonData['journal'];

        // Vous pouvez utiliser ces paramètres pour récupérer les données appropriées depuis votre base de données
        // Supposons que vous avez une méthode dans un repository qui récupère les données filtrées
        // Adaptation à votre structure de base de données

        $pieceComptables = $piececomptablerepository->findFilteredData($fromDate, $toDate, $journal);

        // Préparer les données à renvoyer au format JSON
        $uniqueData = [];
        foreach ($pieceComptables as $pieceComptable) {
            $pieceComptableId = $pieceComptable->getId();
            if (!isset($uniqueData[$pieceComptableId])) {
                $uniqueData[$pieceComptableId] = [
                    'id' => $pieceComptableId,
                    'numeropc' => $pieceComptable->getNumeroPc(),
                    'journal' => $pieceComptable->getJournal()->getJournal(),
                    'datepiece' => $pieceComptable->getDatepiece() ? $pieceComptable->getDatepiece()->format('Y-m-d') : null,
                    'monnaie' => $pieceComptable->getMonnaie()->getMonLib(),
                    'libelle' => $pieceComptable->getLibelle(),
                    'tauxchange' => $pieceComptable->getTauxchange(),
                    'editUrl' => $this->generateUrl('app_piece_comptable_edit', ['id' => $pieceComptableId]),
                ];
            }
        }
        return new JsonResponse(array_values($uniqueData));
    }


    #[Route('/verifnumpc/', name: 'verifnumpc', methods: ['POST'])]
    public function verifnumpc(Request $request, PieceComptableRepository $repository): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $numeroPc = $data['numeroPc'];
        $journal = $data['journal'];
        $idpc = $data['idpc']; // Récupérer l'ID de la pièce courante depuis la requête

        // Votre logique de vérification dans la base de données ici
        // Par exemple, vérifier si le numéro de PC existe dans la base de données en excluant la pièce courante
        $exists = $repository->checkIfNumeroPcExistsForOthers($numeroPc, $idpc, $journal); // Supposons que vous avez une méthode dans votre repository pour cette vérification

        // Si le numéro de PC existe, renvoyer 1, sinon renvoyer 0
        $response = $exists ? 1 : 0;

        return new JsonResponse(['exists' => $response]);
    }


    #[Route('/addnumero/', name: 'add_numero_piece_comptable', methods: ['POST'])]
    public function addnumero(Request $request, PieceComptableRepository $repository): JsonResponse
    {
        $data = json_decode($request->getContent(), true);
        $journal = $data['journal'];
        $datepiece = $data['datepiece'];
        $currentMonth = date('m', strtotime($datepiece));


        // Construire le numéro de pièce comptable en fonction du mois et du compteur
        $pieceNumber = sprintf('%02d', $currentMonth); // Mois

        // Récupérer le dernier numéro de pièce comptable pour ce mois
        $lastPieceNumber = $repository->findLastPieceNumberByMonth($currentMonth,$journal);

        if ($lastPieceNumber) {
            // Extraire le compteur de la dernière pièce
            $lastCounter = intval(substr($lastPieceNumber, 2));

            // Incrémenter le compteur
            $pieceCounter = $lastCounter + 1;
        } else {
            // Si c'est la première pièce du mois, le compteur commence à 1
            $pieceCounter = 1;
        }

        // Construire le numéro de pièce comptable avec le compteur formaté sur 4 chiffres
        $pieceNumber .= sprintf('%05d', $pieceCounter);

        // Retourner le numéro de pièce comptable sous forme de réponse JSON
        return $this->json(['numeroPc' => $pieceNumber]);
    }



}

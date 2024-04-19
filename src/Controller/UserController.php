<?php

namespace App\Controller;
ob_start();
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

#[Route('/user')]
class UserController extends AbstractController
{
    #[Route('/', name: 'app_user_index', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', [
            'users' => $userRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_user_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($user);
            $entityManager->flush();

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/new.html.twig', [
            'users' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_user_show', methods: ['GET'])]
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_user_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form,
        ]);
    }

    #[Route('/users/data/download', name: 'users_data_download')]

    public function usersDataDownload()
    {
        // On définit les options du PDF
        $pdfOptions = new Options();
        // Police par défaut
        $pdfOptions->set('defaultFont', 'Arial');
        $pdfOptions->setIsRemoteEnabled(true);

        // On instancie Dompdf
        $dompdf = new Dompdf($pdfOptions);
        $context = stream_context_create([
            'ssl' => [
                'verify_peer' => FALSE,
                'verify_peer_name' => FALSE,
                'allow_self_signed' => TRUE
            ]
        ]);
        $dompdf->setHttpContext($context);

        // On génère le html
        $html = $this->renderView('user/download.html.twig');

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // On génère un nom de fichier
        if ($this->getUser() !== null) {
            // If the user object is not null, proceed to call getId()
            $fichier = 'user-data-' . $this->getUser()->getId() . '.pdf';
        } else {
            // Handle the case where $this->getUser() returns null
            // For example, you can set a default filename or throw an exception
            $fichier = 'default-filename.pdf';
        }

        // On envoie le PDF au navigateur
        $dompdf->stream($fichier, [
            'Attachment' => true
        ]);

        return new Response();
    }
    #[Route('/{id}', name: 'app_user_delete', methods: ['POST'])]
    public function delete(Request $request, User $user, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $entityManager->remove($user);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/export-users', name: 'export_users')]
    public function exportUsers(UserRepository $userRepository): Response
    {
        // Récupérer les utilisateurs depuis le repository
        $users = $userRepository->findAll();

        // Créer un nouvel objet Spreadsheet
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Entêtes de colonnes
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Email');

        // Remplir les données des utilisateurs
        $row = 2;
        foreach ($users as $user) {
            $sheet->setCellValue('A' . $row, $user->getId());
            $sheet->setCellValue('B' . $row, $user->getEmail());
            $row++;
        }

        // Créer un objet Writer pour écrire le fichier Excel
        $writer = new Xlsx($spreadsheet);

        // Définir les en-têtes pour le téléchargement du fichier Excel
        $response = new Response();
        $response->headers->set('Content-Type', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $response->headers->set('Content-Disposition', 'attachment;filename="export_users.xlsx"');
        $response->headers->set('Cache-Control', 'max-age=0');

        // Écrire le fichier Excel dans la réponse
        $writer->save('php://output');

        return $response;
    }
}

<?php

namespace App\Controller;

use App\Entity\Materiel;
use App\Form\MaterielType;
use App\Form\ReceptionMaterielType;
use App\Repository\MaterielRepository;
use App\Repository\EtatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReceptionController extends AbstractController
{
    #[Route('/reception', name: 'app_reception')]
    public function index(): Response
    {
        return $this->render('reception/index.html.twig', [
            'controller_name' => 'ReceptionController',
        ]);
    }

    // fonction mampiseho ny lisitr'ireo fitaovana tokony ho tonga ao amin'ny service na centre iray, izay efa amin'ny lalana (materiel)
    #[Route('/reception/liste', name: 'app_reception_liste')]
    public function liste(MaterielRepository $materielRepository): Response
    {
        $service = $this->getUser()->getService();
        return $this->render('reception/liste.html.twig', [
            'materiels' => $materielRepository->findBy(["service" => $service, "etat" => 5]),
        ]);
    }

    // fonction manao activation ny matériel tonga ao amin'ny centre iray na service irao
    #[Route('/reception/edit/{id}', name: 'app_reception_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Materiel $materiel, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReceptionMaterielType::class, $materiel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reception_liste', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('materiel/edit.html.twig', [
            'materiel' => $materiel,
            'form' => $form,
        ]);
    }

    // fonction manao activation ny matériel tonga ao amin'ny centre iray na service irao izay nohatsaraina kokoa
    #[Route('/recevoir/{id}', name: 'app_materiel_reception', methods: ['GET', 'POST'])]
    public function MaterielReception($id, EntityManagerInterface $entityManager, EtatRepository $etatRepository, MaterielRepository $materielRepository): Response
    {
        //$materiel = new Materiel();
        //$etat = new Etat();
        // Trouver l'entité Materiel par son ID
        $materiel = $materielRepository->findOneBy(["id" => $id]);
        
        if (!$materiel) {
            throw $this->createNotFoundException('Materiel non trouvé');
        }

        // Trouver l'état avec l'ID 6
        $etat = $etatRepository->findOneBy(["id" => 1]);
        
        if (!$etat) {
            throw $this->createNotFoundException('Etat non trouvé');
        }

        // Changer l'état du materiel et sauvegarder dans la base de données
        $materiel->setEtat($etat);
        $entityManager->persist($materiel);  // Il faut persister les changements
        $entityManager->flush();  // Sauvegarder les changements dans la base de données

        // Redirection après le succès de l'opération
        return $this->redirectToRoute('app_reception_liste', [], Response::HTTP_SEE_OTHER);
    }
}

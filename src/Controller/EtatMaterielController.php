<?php

namespace App\Controller;

use App\Entity\Materiel;
use App\Entity\Etat;
use App\Entity\HistoriqueMateriel;
use App\Form\MaterielType;
use App\Form\EtatMaterielType;
use App\Repository\MaterielRepository;
use App\Repository\EtatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class EtatMaterielController extends AbstractController
{
    // fonction manao redirection amin'ny login fotsiny ito voalohany ito fa tsy dia ilay etat matériel loatra
    #[Route('/', name: 'materiel_service')]
    public function indexPrincipale(): Response
    {
        $user = $this->getUser(); // Récupérer l'utilisateur connecté ou null si aucun utilisateur n'est connecté
        if($user){
            return $this->redirectToRoute("app_etat_materiel_liste");
        } else {
            return $this->redirectToRoute("app_login");
        }
    }

    #[Route('/etat/materiel', name: 'app_etat_materiel')]
    public function index(): Response
    {
        return $this->render('etat_materiel/index.html.twig', [
            'controller_name' => 'EtatMaterielController',
        ]);
    }

    // liste des matériels ao amin'ny service iray na centre iray sady afaka manova ny état
    #[Route('/etat/materiel/liste', name: 'app_etat_materiel_liste')]
    public function liste(Request $request, MaterielRepository $materielRepository, EtatRepository $etatRepository, EntityManagerInterface $entityManager): Response
    {
        // vardump($this->getUser());
        //$service = $this->getUser()->getService();
        //$materiel = $materielRepository->findBy(["service" => $service]);
        $etat_id = $request->request->get('etat_id');
        $materiel_id = $request->request->get('materiel_id');
        if ($etat_id) {
            // Changer l'état du materiel et sauvegarder dans la base de données
            $mat = $materielRepository->findOneBy(['id' => $materiel_id]);
            $etat = $etatRepository->findOneBy(['id' => $etat_id]);
            $mat->setEtat($etat);
            $entityManager->persist($mat);  // Il faut persister les changements
            $entityManager->flush();  // Sauvegarder les changements dans la base de données
        }
        $etats = $etatRepository->findAll();
        $ne_pas_en_possession = [5, 6];
        $materiels = $materielRepository->findByMaterielEnPossession($ne_pas_en_possession, $this->getUser()->getService()->getId());
        return $this->render('etat_materiel/liste.html.twig', [
            'materiels' => $materiels,
            'etats' => $etats,
            //'materiels' => $materielRepository->findAll(),
        ]);
    }

    // fonction manova ny état matériel ho lasa en marche
    #[Route('/{id}/marche', name: 'app_materiel_marche', methods: ['GET', 'POST'])]
    public function MaterielMarche($id, EntityManagerInterface $entityManager, EtatRepository $etatRepository, MaterielRepository $materielRepository): Response
    {
        //$materiel = new Materiel();
        //$etat = new Etat();
        // Trouver l'entité Materiel par son ID
        $historique_materiel = new HistoriqueMateriel();
        $materiel = $materielRepository->findOneBy(["id" => $id]);

        if (!$materiel) {
            throw $this->createNotFoundException('Materiel non trouvé');
        }

        // Trouver l'état avec l'ID 6
        $etat = $etatRepository->findOneBy(["id" => 2]);

        if (!$etat) {
            throw $this->createNotFoundException('Etat non trouvé');
        }

        // Changer l'état du materiel et sauvegarder dans la base de données
        $materiel->setEtat($etat);
        $entityManager->persist($materiel);  // Il faut persister les changements
        $entityManager->flush();  // Sauvegarder les changements dans la base de données

        // Redirection après le succès de l'opération
        return $this->redirectToRoute('app_etat_materiel_liste', [], Response::HTTP_SEE_OTHER);
    }

    // fonction manova ny état matériel ho lasa expédition
    #[Route('/{id}/expedier', name: 'app_materiel_expedition', methods: ['GET', 'POST'])]
    public function MaterielExpedition($id, EntityManagerInterface $entityManager, EtatRepository $etatRepository, MaterielRepository $materielRepository): Response
    {
        //$materiel = new Materiel();
        //$etat = new Etat();
        // Trouver l'entité Materiel par son ID
        $materiel = $materielRepository->findOneBy(["id" => $id]);

        if (!$materiel) {
            throw $this->createNotFoundException('Materiel non trouvé');
        }

        // Trouver l'état avec l'ID 6
        $etat = $etatRepository->findOneBy(["id" => 6]);

        if (!$etat) {
            throw $this->createNotFoundException('Etat non trouvé');
        }

        // Changer l'état du materiel et sauvegarder dans la base de données
        $materiel->setEtat($etat);
        $entityManager->persist($materiel);  // Il faut persister les changements
        $entityManager->flush();  // Sauvegarder les changements dans la base de données

        // Redirection après le succès de l'opération
        return $this->redirectToRoute('app_etat_materiel_liste', [], Response::HTTP_SEE_OTHER);
    }

    // fonction manova ny état matériel ho en panne raha misy fahasimbana
    #[Route('/{id}/panne', name: 'app_materiel_panne', methods: ['GET', 'POST'])]
    public function MaterielPanne($id, EntityManagerInterface $entityManager, EtatRepository $etatRepository, MaterielRepository $materielRepository): Response
    {
        //$materiel = new Materiel();
        //$etat = new Etat();
        // Trouver l'entité Materiel par son ID
        $materiel = $materielRepository->findOneBy(["id" => $id]);
        
        if (!$materiel) {
            throw $this->createNotFoundException('Materiel non trouvé');
        }

        // Trouver l'état avec l'ID 6
        $etat = $etatRepository->findOneBy(["id" => 3]);
        
        if (!$etat) {
            throw $this->createNotFoundException('Etat non trouvé');
        }

        // Changer l'état du materiel et sauvegarder dans la base de données
        $materiel->setEtat($etat);
        $entityManager->persist($materiel);  // Il faut persister les changements
        $entityManager->flush();  // Sauvegarder les changements dans la base de données

        // Redirection après le succès de l'opération
        return $this->redirectToRoute('app_etat_materiel_liste', [], Response::HTTP_SEE_OTHER);
    }

    // fonction manova ny état matériel ho lasa en stock raha entana vao tonga
    #[Route('/{id}/stock', name: 'app_materiel_stock', methods: ['GET', 'POST'])]
    public function MaterielStock($id, EntityManagerInterface $entityManager, EtatRepository $etatRepository, MaterielRepository $materielRepository): Response
    {
        //$materiel = new Materiel();
        //$etat = new Etat();
        // Trouver l'entité Materiel par son ID
        $materiel = $materielRepository->findOneBy(["id" => $id]);
        
        if (!$materiel) {
            throw $this->createNotFoundException('Materiel non trouvé');
        }

        // Trouver l'état avec l'ID 1
        $etat = $etatRepository->findOneBy(["id" => 1]);
        
        if (!$etat) {
            throw $this->createNotFoundException('Etat non trouvé');
        }

        // Changer l'état du materiel et sauvegarder dans la base de données
        $materiel->setEtat($etat);
        $entityManager->persist($materiel);  // Il faut persister les changements
        $entityManager->flush();  // Sauvegarder les changements dans la base de données

        // Redirection après le succès de l'opération
        return $this->redirectToRoute('app_etat_materiel_liste', [], Response::HTTP_SEE_OTHER);
    }

    // fonction manova ny état matériel ho en reparation raha ohatra ka ao anaty fanamborana ilay fitaovana
    #[Route('/{id}/reparation', name: 'app_materiel_reparation', methods: ['GET', 'POST'])]
    public function MaterielReparation($id, EntityManagerInterface $entityManager, EtatRepository $etatRepository, MaterielRepository $materielRepository): Response
    {
        //$materiel = new Materiel();
        //$etat = new Etat();
        // Trouver l'entité Materiel par son ID
        $materiel = $materielRepository->findOneBy(["id" => $id]);
        
        if (!$materiel) {
            throw $this->createNotFoundException('Materiel non trouvé');
        }

        // Trouver l'état avec l'ID 6
        $etat = $etatRepository->findOneBy(["id" => 4]);
        
        if (!$etat) {
            throw $this->createNotFoundException('Etat non trouvé');
        }

        // Changer l'état du materiel et sauvegarder dans la base de données
        $materiel->setEtat($etat);
        $entityManager->persist($materiel);  // Il faut persister les changements
        $entityManager->flush();  // Sauvegarder les changements dans la base de données

        // Redirection après le succès de l'opération
        return $this->redirectToRoute('app_etat_materiel_liste', [], Response::HTTP_SEE_OTHER);
    }
}

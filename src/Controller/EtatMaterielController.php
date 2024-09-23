<?php

namespace App\Controller;

use App\Entity\Materiel;
use App\Entity\Etat;
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

    #[Route('/etat/materiel/liste', name: 'app_etat_materiel_liste')]
    public function liste(MaterielRepository $materielRepository): Response
    {
        // vardump($this->getUser());
        $service = $this->getUser()->getService();
        return $this->render('etat_materiel/liste.html.twig', [
            'materiels' => $materielRepository->findBy(["service" => $service]),
            //'materiels' => $materielRepository->findAll(),
        ]);
    }

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
}

<?php

namespace App\Controller;

use App\Entity\Stock;
use App\Form\StockType;
use App\Form\AjoutStockType;
use App\Entity\Mouvement;
use App\Form\MouvementType;
use App\Form\AjoutMouvementType;
use App\Repository\MaterielRepository;
use App\Repository\TypeMouvementRepository;
use App\Repository\EtatRepository;
use App\Repository\MouvementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

class StockReceptionController extends AbstractController
{
    #[Route('/stock/reception', name: 'app_stock_reception')]
    public function index(): Response
    {
        return $this->render('stock_reception/index.html.twig', [
            'controller_name' => 'StockReceptionController',
        ]);
    }

    #[Route('/reception/liste', name: 'app_reception_liste')]
    public function liste(MouvementRepository $mouvementRepository): Response
    {
        $service = $this->getUser()->getService();
        return $this->render('reception/liste.html.twig', [
            'Mouvement' => $mouvementRepository->findBy(["service" => $service, "etat" => 6]),
        ]);
    }

    #[Route('/stock/reception/{id}', name: 'app_stock_reception', methods: ['GET', 'POST'])]
    public function stock_ajout($id, EntityManagerInterface $entityManager, MouvementRepository $mouvementRepository, TypeMouvementRepository $typeMouvementRepository, EtatRepository $etatRepository): Response
    {
        // fonction manao reception entana amin'ny destinataire no eto
        $source_mouvement = $mouvementRepository->findOneBy(["id" => $id]);

        if (!$source_mouvement) {
            throw $this->createNotFoundException('Materiel non trouvé');
        }
        $target_mouvement = new Mouvement();

        $etat = $etatRepository->findOneBy(["id" => 1]);
        $type = $typeMouvementRepository->findOneBy(["id" => 1]);

        // Changer l'état du materiel et sauvegarder dans la base de données
        $target_mouvement->setProduit($source_mouvement->getProduit());
        $target_mouvement->setType($type);
        $target_mouvement->setQuantite($source_mouvement->getQuantite());
        $target_mouvement->setEtat($etat);
        $target_mouvement->setService($source_mouvement->getService());
        $target_mouvement->setUnite($source_mouvement->getUnite());
        $target_mouvement->setDate($source_mouvement->getDate());
        $target_mouvement->setFournisseur($source_mouvement->getFournisseur());
        $target_mouvement->setReference($source_mouvement->getReference());
        $target_mouvement->setDebutSerie($source_mouvement->getDebutSerie());
        $target_mouvement->setFinSerie($source_mouvement->getFinSerie());
        $target_mouvement->setObservation($source_mouvement->getObservation());
        $target_mouvement->setExpiration($source_mouvement->getExpiration());
        $target_mouvement->setExpeditionId($source_mouvement->getId());
        $target_mouvement->setDateReception(new DateTime());
        $target_mouvement->setUserReception($this->getUser());
        $target_mouvement->setUserExpedition($source_mouvement->getUserExpedition());

        $entityManager->persist($target_mouvement);  // Il faut persister les changements

        $etat_2 = $etatRepository->findOneBy(["id" => 5]);
        $source_mouvement->setEtat($etat_2);

        $entityManager->persist($source_mouvement);  // Il faut persister les changements

        $entityManager->flush();  // Sauvegarder les changements dans la base de données

        // Redirection après le succès de l'opération
        return $this->redirectToRoute('app_reception_liste', [], Response::HTTP_SEE_OTHER);
    }
}

<?php

namespace App\Controller;

use App\Entity\Materiel;
use App\Form\MaterielType;
use App\Entity\Stock;
use App\Form\CommandeType;
use App\Form\AjoutType;
use App\Form\StockType;
use App\Form\AjoutStockType;
use App\Form\FournisseurMouvementType;
use App\Entity\Mouvement;
use App\Form\MouvementType;
use App\Form\AjoutMouvementType;
use App\Repository\MaterielRepository;
use App\Repository\TypeMouvementRepository;
use App\Repository\EtatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

// cette class permet l'ajout des articles livrés par les fournisseur
class AjoutController extends AbstractController
{
    #[Route('/ajout', name: 'app_ajout')]
    public function index(): Response
    {
        return $this->render('ajout/index.html.twig', [
            'controller_name' => 'AjoutController',
        ]);
    }

    #[Route('/stock/ajout/fournisseur', name: 'app_stock_ajout_fournisseur', methods: ['GET', 'POST'])]
    public function stock_ajout(Request $request, EntityManagerInterface $entityManager, TypeMouvementRepository $typeMouvementRepository, EtatRepository $etatRepository): Response
    {
        // fonction manao ajout entana amin'ny destinataire no eto
        $mouvement = new Mouvement();
        $form = $this->createForm(FournisseurMouvementType::class, $mouvement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mouvement->setDate(new DateTime());
            //$stock->setService($this->getUser()->getService());
            $type = $typeMouvementRepository->findOneBy(["id" => 1]);
            $etat = $etatRepository->findOneBy(["id" => 1]);
            $mouvement->setUserExpedition($this->getUser());
            $mouvement->setType($type);
            $mouvement->setEtat($etat);
            $entityManager->persist($mouvement);
            $entityManager->flush();

            return $this->redirectToRoute('materiel_service', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('stock_ajout/ajout_stock.html.twig', [
            'materiel' => $mouvement,
            'form' => $form,
        ]);
    }

    #[Route('/ajout/new', name: 'app_materiel_ajout_new', methods: ['GET', 'POST'])]
    public function commande(Request $request, EntityManagerInterface $entityManager): Response
    {
        $materiel = new Materiel();
        $form = $this->createForm(AjoutType::class, $materiel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $materiel->setDate(new DateTime());
            $materiel->setService($this->getUser()->getService());
            $materiel->setUser($this->getUser());
            $entityManager->persist($materiel);
            $entityManager->flush();

            return $this->redirectToRoute('materiel_service', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('ajout/index.html.twig', [
            'materiel' => $materiel,
            'form' => $form,
        ]);
    }
}

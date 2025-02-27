<?php

namespace App\Controller;

use App\Entity\Stock;
use App\Form\StockType;
use App\Form\AjoutStockType;
use App\Entity\Mouvement;
use App\Form\MouvementType;
use App\Form\AjoutMouvementType;
use App\Repository\MaterielRepository;
use App\Repository\MouvementRepository;
use App\Repository\TypeMouvementRepository;
use App\Repository\EtatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

class StockExpeditionController extends AbstractController
{
    #[Route('/stock/expedition', name: 'app_stock_expedition')]
    public function index(): Response
    {
        return $this->render('stock_expedition/index.html.twig', [
            'controller_name' => 'StockExpeditionController',
        ]);
    }

    // fonction misy ny liste fourniture en cours d'expédition
    #[Route('/stock/expedition/liste', name: 'app_expedition_stock_liste')]
    public function liste(MouvementRepository $mouvementRepository): Response
    {
        $service = $this->getUser()->getService();
        return $this->render('stock_expedition/liste.html.twig', [
            'mouvements' => $mouvementRepository->findBy(["service" => $service, "etat" => 6]),
        ]);
    }

    // fonction manao expédition entana amin'ny service na centre
    #[Route('/stock/expedition/new', name: 'app_stock_expedition_new', methods: ['GET', 'POST'])]
    public function stock_ajout(Request $request, EntityManagerInterface $entityManager, TypeMouvementRepository $typeMouvementRepository, EtatRepository $etatRepository): Response
    {
        // fonction manao expedition entana amin'ny destinataire no eto
        $mouvement = new Mouvement();
        $form = $this->createForm(AjoutMouvementType::class, $mouvement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mouvement->setDate(new DateTime());
            //$stock->setService($this->getUser()->getService());
            $type = $typeMouvementRepository->findOneBy(["id" => 2]);
            $etat = $etatRepository->findOneBy(["id" => 6]);
            $mouvement->setUserExpedition($this->getUser());
            $mouvement->setType($type);
            $mouvement->setEtat($etat);
            $entityManager->persist($mouvement);
            $entityManager->flush();

            return $this->redirectToRoute('app_etat_stock_liste', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('stock_ajout/ajout_stock.html.twig', [
            'mouvements' => $mouvement,
            'form' => $form,
        ]);
    }
}

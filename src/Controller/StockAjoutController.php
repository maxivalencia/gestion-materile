<?php

namespace App\Controller;

use App\Entity\Stock;
use App\Form\StockType;
use App\Form\AjoutStockType;
use App\Entity\Mouvement;
use App\Entity\Unite;
use App\Form\MouvementType;
use App\Form\AjoutMouvementType;
use App\Repository\MaterielRepository;
use App\Repository\StockRepository;
use App\Repository\TypeMouvementRepository;
use App\Repository\UniteRepository;
use App\Repository\ConversionRepository;
use App\Repository\EtatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

class StockAjoutController extends AbstractController
{
    #[Route('/stock/ajout', name: 'app_stock_ajout')]
    public function index(): Response
    {
        return $this->render('stock_ajout/index.html.twig', [
            'controller_name' => 'StockAjoutController',
        ]);
    }

    #[Route('/stock/ajout/new', name: 'app_stock_ajout_new', methods: ['GET', 'POST'])]
    public function stock_ajout(Request $request, ConversionRepository $conversionRepository, EntityManagerInterface $entityManager, TypeMouvementRepository $typeMouvementRepository, EtatRepository $etatRepository, StockRepository $stockRepository): Response
    {
        // fonction manao ajout entana amin'ny destinataire no eto
        $mouvement = new Mouvement();
        $form = $this->createForm(AjoutMouvementType::class, $mouvement);
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

            $stock = $stockRepository->findOneBy(["produit" => $mouvement->getProduit(), "service" => $mouvement->getService()]);
            // mila atao ny unité farany ambany ny ato anaty gestion de stock
            // izany hoe atao recherche ny unité farany ambany sy ny conversion izany
            $quantite = $mouvement->getQuantite();
            $unite = $mouvement->getUnite();
            while ($conversionRepository->findOneBy(["source" => $unite, "produit" => $mouvement->getProduit()])){
                $conversion = $conversionRepository->findOneBy(["source" => $unite, "produit" => $mouvement->getProduit()]);
                $quantite = $quantite * $conversion->getQuantite();
                $unite = $conversion->getDestinataire();
            }
            if($stock == null){
                $stock = new Stock();
                $stock->setProduit($mouvement->getProduit());
                $stock->setQuantite($quantite);
                $stock->setUnite($unite);
                $stock->setService($mouvement->getService());
                $stock->setDate(new DateTime());
            } else {
                $stock->setQuantite($stock->getQuantite() + $quantite);
                $stock->setDate(new DateTime());
            }
            $entityManager->persist($stock);
            $entityManager->flush();

            return $this->redirectToRoute('app_etat_stock_liste', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('stock_ajout/ajout_stock.html.twig', [
            'materiel' => $mouvement,
            'form' => $form,
        ]);
    }
}

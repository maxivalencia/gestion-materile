<?php

namespace App\Controller;

use App\Entity\Stock;
use App\Form\StockType;
use App\Repository\StockRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\EtatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtatStockController extends AbstractController
{
    #[Route('/etat/stock', name: 'app_etat_stock')]
    public function index(): Response
    {
        return $this->render('etat_stock/index.html.twig', [
            'controller_name' => 'EtatStockController',
        ]);
    }

    // fonction manao affichage ny stock ao anaty service na fonction iray
    #[Route('/etat/stock/liste', name: 'app_etat_stock_liste')]
    public function liste(Request $request, StockRepository $stockRepository, EtatRepository $etatRepository, EntityManagerInterface $entityManager): Response
    {
        //$stocks = $stockRepository->findByStockEnPossession($this->getUser()->getService()->getId());
        $stocks = $stockRepository->findBy(["service" => $this->getUser()->getService()]);
        return $this->render('etat_stock/liste.html.twig', [
            'stocks' => $stocks,
        ]);
    }

    // fonction manao affichage ny stock ao anaty service na fonction iray
    #[Route('/etat/stock/liste/approvisionnement', name: 'app_etat_stock_liste_approvisionnement')]
    public function liste_approvisionnement(Request $request, StockRepository $stockRepository, EtatRepository $etatRepository, EntityManagerInterface $entityManager): Response
    {
        //$stocks = $stockRepository->findByStockEnPossession($this->getUser()->getService()->getId());
        $stocks = $stockRepository->findBy(["service" => $this->getUser()->getService()]);
        return $this->render('etat_stock/liste.html.twig', [
            'stocks' => $stocks,
        ]);
    }
}

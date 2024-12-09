<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StockCommandeController extends AbstractController
{
    #[Route('/stock/commande', name: 'app_stock_commande')]
    public function index(): Response
    {
        return $this->render('stock_commande/index.html.twig', [
            'controller_name' => 'StockCommandeController',
        ]);
    }
}

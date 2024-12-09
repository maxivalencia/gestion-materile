<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StockExpeditionController extends AbstractController
{
    #[Route('/stock/expedition', name: 'app_stock_expedition')]
    public function index(): Response
    {
        return $this->render('stock_expedition/index.html.twig', [
            'controller_name' => 'StockExpeditionController',
        ]);
    }
}

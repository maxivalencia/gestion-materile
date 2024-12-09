<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StockAjoutController extends AbstractController
{
    #[Route('/stock/ajout', name: 'app_stock_ajout')]
    public function index(): Response
    {
        return $this->render('stock_ajout/index.html.twig', [
            'controller_name' => 'StockAjoutController',
        ]);
    }
}

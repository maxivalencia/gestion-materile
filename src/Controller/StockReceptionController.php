<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StockReceptionController extends AbstractController
{
    #[Route('/stock/reception', name: 'app_stock_reception')]
    public function index(): Response
    {
        return $this->render('stock_reception/index.html.twig', [
            'controller_name' => 'StockReceptionController',
        ]);
    }
}

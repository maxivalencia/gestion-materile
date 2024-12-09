<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}

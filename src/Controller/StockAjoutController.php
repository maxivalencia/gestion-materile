<?php

namespace App\Controller;

use App\Entity\Materiel;
use App\Form\MaterielType;
use App\Form\AjoutType;
use App\Entity\Stock;
use App\StockType;
use App\Repository\MaterielRepository;
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

    #[Route('/stock/ajout/new', name: 'app_materiel_ajout_new', methods: ['GET', 'POST'])]
    public function stock_ajout(Request $request, EntityManagerInterface $entityManager): Response
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

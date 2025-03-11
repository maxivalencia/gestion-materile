<?php

namespace App\Controller;

use App\Entity\Materiel;
use App\Entity\Stock;
use App\Form\MaterielType;
use App\Form\StockType;
use App\Form\ExpeditionMaterielType;
use App\Form\ExpeditionStockType;
use App\Repository\MaterielRepository;
use App\Repository\StockRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ExpeditionController extends AbstractController
{
    #[Route('/expedition', name: 'app_expedition')]
    public function index(): Response
    {
        return $this->render('expedition/index.html.twig', [
            'controller_name' => 'ExpeditionController',
        ]);
    }

    // fonction mampiseo ny lisitr'ireo matériel encours d'expédition
    #[Route('/expedition/liste', name: 'app_expedition_liste')]
    public function liste(MaterielRepository $materielRepository): Response
    {
        $service = $this->getUser()->getService();
        return $this->render('expedition/liste.html.twig', [
            'materiels' => $materielRepository->findBy(["service" => $service, "etat" => 6]),
        ]);
    }

    // fonction manao expédition matériel any amin'ny service na centre
    #[Route('/expedition/edit/{id}', name: 'app_expedition_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Materiel $materiel, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ExpeditionMaterielType::class, $materiel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_expedition_liste', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('materiel/edit.html.twig', [
            'materiel' => $materiel,
            'form' => $form,
        ]);
    }
}

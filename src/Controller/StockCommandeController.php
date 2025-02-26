<?php

namespace App\Controller;

use App\Entity\Stock;
use App\Form\StockType;
use App\Form\AjoutStockType;
use App\Entity\Mouvement;
use App\Form\MouvementType;
use App\Form\AjoutMouvementType;
use App\Repository\TypeMouvementRepository;
use App\Repository\EtatRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;

class StockCommandeController extends AbstractController
{
    #[Route('/stock/commande', name: 'app_stock_commande')]
    public function index(): Response
    {
        return $this->render('stock_commande/index.html.twig', [
            'controller_name' => 'StockCommandeController',
        ]);
    }

    #[Route('/stock/commande/new', name: 'app_stock_commande_new', methods: ['GET', 'POST'])]
    public function stock_commande(Request $request, EntityManagerInterface $entityManager, TypeMouvementRepository $typeMouvementRepository, EtatRepository $etatRepository): Response
    {
        // fonction manao expedition entana amin'ny destinataire no eto
        $mouvement = new Mouvement();
        $form = $this->createForm(AjoutMouvementType::class, $mouvement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $mouvement->setDate(new DateTime());
            //$stock->setService($this->getUser()->getService());
            //$type = $typeMouvementRepository->findOneBy(["id" => 2]);
            $etat = $etatRepository->findOneBy(["id" => 10]);
            $mouvement->setUserExpedition($this->getUser());
            //$mouvement->setType($type);
            $mouvement->setEtat($etat);
            $entityManager->persist($mouvement);
            $entityManager->flush();

            return $this->redirectToRoute('app_etat_stock_liste', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('stock_commande/commande_stock.html.twig', [
            'materiel' => $mouvement,
            'form' => $form,
        ]);
    }
}

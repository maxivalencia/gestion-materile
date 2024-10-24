<?php

namespace App\Controller;

use App\Entity\HistoriqueMateriel;
use App\Form\HistoriqueMaterielType;
use App\Repository\HistoriqueMaterielRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/historique/materiel')]
class HistoriqueMaterielController extends AbstractController
{
    #[Route('/', name: 'app_historique_materiel_index', methods: ['GET'])]
    public function index(HistoriqueMaterielRepository $historiqueMaterielRepository): Response
    {
        return $this->render('historique_materiel/index.html.twig', [
            'historique_materiels' => $historiqueMaterielRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_historique_materiel_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $historiqueMateriel = new HistoriqueMateriel();
        $form = $this->createForm(HistoriqueMaterielType::class, $historiqueMateriel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($historiqueMateriel);
            $entityManager->flush();

            return $this->redirectToRoute('app_historique_materiel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('historique_materiel/new.html.twig', [
            'historique_materiel' => $historiqueMateriel,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_historique_materiel_show', methods: ['GET'])]
    public function show(HistoriqueMateriel $historiqueMateriel): Response
    {
        return $this->render('historique_materiel/show.html.twig', [
            'historique_materiel' => $historiqueMateriel,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_historique_materiel_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, HistoriqueMateriel $historiqueMateriel, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(HistoriqueMaterielType::class, $historiqueMateriel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_historique_materiel_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('historique_materiel/edit.html.twig', [
            'historique_materiel' => $historiqueMateriel,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_historique_materiel_delete', methods: ['POST'])]
    public function delete(Request $request, HistoriqueMateriel $historiqueMateriel, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$historiqueMateriel->getId(), $request->request->get('_token'))) {
            $entityManager->remove($historiqueMateriel);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_historique_materiel_index', [], Response::HTTP_SEE_OTHER);
    }
}

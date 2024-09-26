<?php

namespace App\Controller;

use App\Entity\GenreProduit;
use App\Form\GenreProduitType;
use App\Repository\GenreProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/genre/produit')]
class GenreProduitController extends AbstractController
{
    #[Route('/', name: 'app_genre_produit_index', methods: ['GET'])]
    public function index(GenreProduitRepository $genreProduitRepository): Response
    {
        return $this->render('genre_produit/index.html.twig', [
            'genre_produits' => $genreProduitRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_genre_produit_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $genreProduit = new GenreProduit();
        $form = $this->createForm(GenreProduitType::class, $genreProduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($genreProduit);
            $entityManager->flush();

            return $this->redirectToRoute('app_genre_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('genre_produit/new.html.twig', [
            'genre_produit' => $genreProduit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_genre_produit_show', methods: ['GET'])]
    public function show(GenreProduit $genreProduit): Response
    {
        return $this->render('genre_produit/show.html.twig', [
            'genre_produit' => $genreProduit,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_genre_produit_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, GenreProduit $genreProduit, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(GenreProduitType::class, $genreProduit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_genre_produit_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('genre_produit/edit.html.twig', [
            'genre_produit' => $genreProduit,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_genre_produit_delete', methods: ['POST'])]
    public function delete(Request $request, GenreProduit $genreProduit, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$genreProduit->getId(), $request->request->get('_token'))) {
            $entityManager->remove($genreProduit);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_genre_produit_index', [], Response::HTTP_SEE_OTHER);
    }
}

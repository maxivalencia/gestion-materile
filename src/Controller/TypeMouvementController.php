<?php

namespace App\Controller;

use App\Entity\TypeMouvement;
use App\Form\TypeMouvementType;
use App\Repository\TypeMouvementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/type/mouvement')]
class TypeMouvementController extends AbstractController
{
    #[Route('/', name: 'app_type_mouvement_index', methods: ['GET'])]
    public function index(TypeMouvementRepository $typeMouvementRepository): Response
    {
        return $this->render('type_mouvement/index.html.twig', [
            'type_mouvements' => $typeMouvementRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_type_mouvement_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $typeMouvement = new TypeMouvement();
        $form = $this->createForm(TypeMouvementType::class, $typeMouvement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($typeMouvement);
            $entityManager->flush();

            return $this->redirectToRoute('app_type_mouvement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_mouvement/new.html.twig', [
            'type_mouvement' => $typeMouvement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_mouvement_show', methods: ['GET'])]
    public function show(TypeMouvement $typeMouvement): Response
    {
        return $this->render('type_mouvement/show.html.twig', [
            'type_mouvement' => $typeMouvement,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_type_mouvement_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, TypeMouvement $typeMouvement, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TypeMouvementType::class, $typeMouvement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_type_mouvement_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_mouvement/edit.html.twig', [
            'type_mouvement' => $typeMouvement,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_type_mouvement_delete', methods: ['POST'])]
    public function delete(Request $request, TypeMouvement $typeMouvement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeMouvement->getId(), $request->request->get('_token'))) {
            $entityManager->remove($typeMouvement);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_type_mouvement_index', [], Response::HTTP_SEE_OTHER);
    }
}

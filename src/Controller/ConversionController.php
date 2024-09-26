<?php

namespace App\Controller;

use App\Entity\Conversion;
use App\Form\ConversionType;
use App\Repository\ConversionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/conversion')]
class ConversionController extends AbstractController
{
    #[Route('/', name: 'app_conversion_index', methods: ['GET'])]
    public function index(ConversionRepository $conversionRepository): Response
    {
        return $this->render('conversion/index.html.twig', [
            'conversions' => $conversionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_conversion_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $conversion = new Conversion();
        $form = $this->createForm(ConversionType::class, $conversion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($conversion);
            $entityManager->flush();

            return $this->redirectToRoute('app_conversion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('conversion/new.html.twig', [
            'conversion' => $conversion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_conversion_show', methods: ['GET'])]
    public function show(Conversion $conversion): Response
    {
        return $this->render('conversion/show.html.twig', [
            'conversion' => $conversion,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_conversion_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Conversion $conversion, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ConversionType::class, $conversion);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_conversion_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('conversion/edit.html.twig', [
            'conversion' => $conversion,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_conversion_delete', methods: ['POST'])]
    public function delete(Request $request, Conversion $conversion, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$conversion->getId(), $request->request->get('_token'))) {
            $entityManager->remove($conversion);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_conversion_index', [], Response::HTTP_SEE_OTHER);
    }
}

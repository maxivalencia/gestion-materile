<?php

namespace App\Controller;

use App\Entity\Materiel;
use App\Form\MaterielType;
use App\Form\ReceptionMaterielType;
use App\Repository\MaterielRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReceptionController extends AbstractController
{
    #[Route('/reception', name: 'app_reception')]
    public function index(): Response
    {
        return $this->render('reception/index.html.twig', [
            'controller_name' => 'ReceptionController',
        ]);
    }

    #[Route('/reception/liste', name: 'app_reception_liste')]
    public function liste(MaterielRepository $materielRepository): Response
    {
        $service = $this->getUser()->getService();
        return $this->render('reception/liste.html.twig', [
            'materiels' => $materielRepository->findBy(["service" => $service, "etat" => 5]),
        ]);
    }

    #[Route('/reception/{id}/edit', name: 'app_reception_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Materiel $materiel, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ReceptionMaterielType::class, $materiel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_reception_liste', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('materiel/edit.html.twig', [
            'materiel' => $materiel,
            'form' => $form,
        ]);
    }
}

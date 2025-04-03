<?php

namespace App\Controller;

use App\Entity\CelestialBodies;
use App\Form\CelestialFormType;
use App\Repository\CelestialBodiesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CelestialController extends AbstractController
{
    #[Route('/celestial', name: 'app_celestial')]
    public function show(Request $request, CelestialBodiesRepository $celestialBodiesRepository): Response
    {

        $celestialBody = new CelestialBodies();
        $form = $this->createForm(CelestialFormType::class, $celestialBody);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $celestialBodiesRepository->add($form->getData(), true);

            return $this->redirectToRoute('app_celestial');
        }

        $celestialBodies = $celestialBodiesRepository->findAll();

        return $this->render('celestial/index.html.twig', [
            'controller_name' => 'CelestialController',
            'celestial_bodies' => $celestialBodies,
            'celestial_form' => $form->createView(),
        ]);
    }
}
<?php

namespace App\Controller;

use App\Entity\CelestialBodies;
use App\Form\CelestialFormType;
use App\Repository\CelestialBodiesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class CelestialController extends AbstractController
{
    #[Route('/celestial', name: 'app_celestial')]
    public function show(Request $request, CelestialBodiesRepository $celestialBodiesRepository, #[Autowire('%photo_dir%')] string $photoDir,): Response
    {
        $celestialBody = new CelestialBodies();

        // Crée le formulaire sans le champ "addedBy"
        $form = $this->createForm(CelestialFormType::class, $celestialBody);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Définit l'utilisateur connecté comme "addedBy"
            $celestialBody->setAddedBy($this->getUser());

            if ($photo = $form['image_url']->getData()) {
                $filename = bin2hex(random_bytes(6)).'.'.$photo->guessExtension();
                $photo->move($photoDir, $filename);
                $celestialBody->setImageUrl($filename);
            }

            // Sauvegarde l'entité
            $celestialBodiesRepository->add($celestialBody, true);

            $this->addFlash('success', 'Le corps céleste a été ajouté avec succès.');

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
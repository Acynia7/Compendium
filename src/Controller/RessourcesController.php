<?php

namespace App\Controller;

use App\Entity\RelatedRessources;
use App\Form\RessourcesType;
use App\Repository\RelatedRessourcesRepository;
use App\Repository\CelestialBodiesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class RessourcesController extends AbstractController
{
    #[Route('/ressources/{id}', name: 'app_ressources')]
    public function index(int $id, Request $request, RelatedRessourcesRepository $relatedRessourcesRepository, CelestialBodiesRepository $celestialBodiesRepository): Response 
    {
        $ressource = new RelatedRessources();

        // Récupère le corps céleste à partir de l'id
        $celestialBody = $celestialBodiesRepository->find($id);
        if (!$celestialBody) {
            throw $this->createNotFoundException('Corps céleste non trouvé.');
        }

        $form = $this->createForm(RessourcesType::class, $ressource);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ressource->setCelestialBodyId($celestialBody);
            $ressource->setUser($this->getUser());

            $relatedRessourcesRepository->add($ressource, true);

            $this->addFlash('success', 'La ressource a été soumise avec succès.');

            return $this->redirectToRoute('app_ressources', ['id' => $id]);
        }

        $ressources = $relatedRessourcesRepository->findAll();

        return $this->render('ressources/index.html.twig', [
            'controller_name' => 'RessourcesController',
            'ressources' => $ressources,
            'ressource_form' => $form->createView(),
            'celestial_body' => $celestialBody,
        ]);
    }
}

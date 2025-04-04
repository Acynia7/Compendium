<?php

namespace App\Controller;

use App\Entity\CelestialBodies;
use App\Repository\CelestialBodiesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CelestialBodiesRepository $celestialBodiesRepository): Response
    {
        // Récupère toutes les entités CelestialBodies
        $celestialBodies = $celestialBodiesRepository->findAll();

        // Passe les données au template
        return $this->render('home/index.html.twig', [
            'celestialBodies' => $celestialBodies,
        ]);
    }
}

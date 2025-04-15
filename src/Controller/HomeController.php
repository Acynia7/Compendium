<?php

namespace App\Controller;

use App\Entity\CelestialBodies;
use App\Entity\CelestialBodyType;
use App\Repository\CelestialBodiesRepository;
use App\Repository\CelestialBodyTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(CelestialBodiesRepository $celestialBodiesRepository): Response
    {
        $celestialBodies = $celestialBodiesRepository->findAll();

        return $this->render('home/index.html.twig', [
            'celestialBodies' => $celestialBodies,
        ]);
    }

    #[Route('/show/{celestialBodies<\d+>}', name: 'app_show')]
    public function show(
        #[MapEntity(mapping: ['celestialBodies' => 'id'])] CelestialBodies $celestialBodies
    ): Response {
        return $this->render('celestial/show.html.twig', [
            'celestialBodies' => $celestialBodies,
            'celestialBodyType' => $celestialBodies->getType(),
        ]);
    }
}

<?php

namespace App\Controller;

use App\Repository\CelestialBodiesRepository;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SearchController extends AbstractController
{
    #[Route('/search', name: 'app_search')]
    public function handleSearch(Request $request, CelestialBodiesRepository $repo)
    {
        $query = $request->request->all('form')['search'];
        if($query) {
            $celestialBodies = $repo->findCelestialBodiesByName($query);
        }

        return $this->render('search/index.html.twig', [
            'celestialBodies' => $celestialBodies
        ]);
    }


    public function searchBar()
    {
        $form = $this->createFormBuilder()
            ->setAction($this->generateUrl('app_search'))
            ->add('search', TextType::class, [
                'label' => false,
                'attr' => [
                    'placeholder' => 'Entrez un nom',
                    'class' => 'form-control',
                ],
            ])
            ->getForm();

        return $this->render('search/searchBar.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}

<?php

namespace App\Controller\Admin;

use App\Entity\CelestialBodyType;
use App\Entity\CelestialBodies;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Attribute\AdminDashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;

#[AdminDashboard(routePath: '/admin', routeName: 'admin')]
class DashboardController extends AbstractDashboardController
{
    public function index(): Response
    {
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(CelestialBodiesCrudController::class)->generateUrl();

        return $this->redirect($url);

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('App');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Celestial Bodies', 'fas fa-globe', CelestialBodies::class);
        yield MenuItem::linkToCrud('Celestial Body Types', 'fas fa-globe', CelestialBodyType::class);
        yield MenuItem::linkToCrud('Related Ressources', 'fas fa-link', 'App\Entity\RelatedRessources');
        yield MenuItem::linkToCrud('Related Ressources Type', 'fas fa-link', 'App\Entity\RelatedRessourcesType');
        yield MenuItem::linkToCrud('Users', 'fa fa-user', User::class);
    }
}

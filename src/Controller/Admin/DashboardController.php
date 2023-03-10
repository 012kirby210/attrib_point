<?php

namespace App\Controller\Admin;

use App\Entity\Attribution;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Point Attribution')
			->renderContentMaximized()
			->renderSidebarMinimized()
			->generateRelativeUrls();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
		yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-user', User::class)
			->setAction('index');
		yield MenuItem::linkToCrud('Attributions', 'fa fa-check', Attribution::class)
			->setAction('index');
    }
}

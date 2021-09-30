<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Calender;
use App\Entity\Category;
use App\Entity\Content;

use App\Entity\Department;
use App\Entity\Partner;
use App\Entity\Project;
use App\Entity\Type;
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
            ->setTitle('Agent Environment');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Articles', 'fas fa-list', Article::class);
        yield MenuItem::linkToCrud('Calenders', 'fas fa-list', Calender::class);
        yield MenuItem::linkToCrud('Categories', 'fas fa-list', Category::class);
        yield MenuItem::linkToCrud('Contents', 'fas fa-list', Content::class);
        yield MenuItem::linkToCrud('Departments', 'fas fa-list', Department::class);
        yield MenuItem::linkToCrud('Partners', 'fas fa-list', Partner::class);
        yield MenuItem::linkToCrud('Projects', 'fas fa-list', Project::class);
        yield MenuItem::linkToCrud('Type', 'fas fa-list', Type::class);
        yield MenuItem::linkToCrud('Users', 'fas fa-list', User::class);
    }
}

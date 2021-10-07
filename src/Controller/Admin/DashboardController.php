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

use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
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
//        redirect to some CRUD controller
//        $routeBuilder = $this->get(AdminUrlGenerator::class);
//
//        return $this->redirect($routeBuilder->setController(OneOfYourCrudController::class)->generateUrl());
//
//        // you can also redirect to different pages depending on the current user
//        if ('jane' === $this->getUser()->getUsername()) {
//            return $this->redirect('...');
//        }
//
//        // you can also render some template to display a proper Dashboard
//        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
//        return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Agent Environment');
    }
    public function configureAssets(): Assets
    {
        return Assets::new()->addCssFile('css/admin.css');
    }
    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Menu');
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linktoDashboard('Account', 'fa fa-address-card');
        yield MenuItem::subMenu('Database Settings', 'fa fa-database')->setSubItems([
            MenuItem::linkToCrud('Articles', 'fas fa-file-alt', Article::class),
            MenuItem::linkToCrud('Calenders', 'fas fa-calendar', Calender::class),
            MenuItem::linkToCrud('Categories', 'fas fa-archive', Category::class),
            MenuItem::linkToCrud('Contents', 'fas fa-file', Content::class),
            MenuItem::linkToCrud('Departments', 'fas fa-building', Department::class),
            MenuItem::linkToCrud('Partners', 'fas fa-address-book', Partner::class),
            MenuItem::linkToCrud('Projects', 'fas fa-folder', Project::class),
            MenuItem::linkToCrud('Type', 'fas fa-code', Type::class),
            MenuItem::linkToCrud('Users', 'fas fa-user', User::class)
        ]);

        yield MenuItem::linkToLogout('Logout', 'fa fa-user');
    }
}

<?php

namespace App\Controller\Admin;

use App\Entity\Comment;
use App\Entity\Conference;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
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
        
        //Elegimos como página de inicio del Administrador, el CRUD de Conference        
        $routeBuilder = $this->get(AdminUrlGenerator::class);
        return $this->redirect($routeBuilder->setController(ConferenceCrudController::class)->generateUrl());        
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()            
            ->setTitle('<img src="images/under-construction.gif">');
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
            MenuItem::section('Conferencias'),
            MenuItem::linkToCrud('Conferencias', 'fas fa-list', Conference::class),
            MenuItem::section('Comentarios'),
            MenuItem::linkToCrud('Comentarios', 'fas fa-car', Comment::class),
        ];        
    }

    /*
    public function configureCrud(): Crud
    {
        return Crud::new()
            // this defines the pagination size for ALL CRUD controllers
            // (each CRUD controller can OVERRIDE this value if needed)
            ->setPaginatorPageSize(30)
            //->renderSidebarMinimized()
        ;
    }
    */
}

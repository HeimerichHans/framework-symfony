<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\ListBrand;
use App\Entity\ListCylinder;
use App\Entity\ListColor;
use App\Entity\Comments;
use App\Entity\ListType;
use App\Entity\Moto;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Egulias\EmailValidator\Parser\Comment;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $routeBuilder = $this->container->get(AdminUrlGenerator::class);
        $url = $routeBuilder->setController(ListColorCrudController::class)->generateUrl();
        $url = $routeBuilder->setController(ListBrandCrudController::class)->generateUrl();
        $url = $routeBuilder->setController(ListCylinderCrudController::class)->generateUrl();
        $url = $routeBuilder->setController(ListTypeCrudController::class)->generateUrl();
        $url = $routeBuilder->setController(CommentsCrudController::class)->generateUrl();
        $url = $routeBuilder->setController(MotoCrudController::class)->generateUrl();
        $url = $routeBuilder->setController(UserCrudController::class)->generateUrl();

        return $this->redirect($url);

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('App');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoRoute('Back to the website','fas fa-home','homepage');
        yield MenuItem::linkToCrud('User','fa fa-user',User::class);
        yield MenuItem::linkToCrud('Moto','fa fa-motorcycle',Moto::class);
        yield MenuItem::linkToCrud('Cylindre','fa fa-cc',ListCylinder::class);
        yield MenuItem::linkToCrud('Couleur','fa fa-eyedropper',ListColor::class);
        yield MenuItem::linkToCrud('Marque','fa fa-cog',ListBrand::class);
        yield MenuItem::linkToCrud('Type','fa fa-cog',ListType::class);
        yield MenuItem::linkToCrud('Commentaire','fa fa-comments',Comments::class);
    }
}

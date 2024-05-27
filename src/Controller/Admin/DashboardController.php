<?php

namespace App\Controller\Admin;

use App\Entity\PlaceCity;
use App\Entity\PlaceType;
use App\Entity\Rating;
use App\Entity\User;
use App\Entity\TripRating;
use App\Entity\Place;
use App\Entity\Trip;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {
    }
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator
            ->setController(UserCrudController::class)
            ->generateUrl();
        return $this->redirect($url);
        $url = $this->adminUrlGenerator
            ->setController(PlaceCrudController::class)
            ->generateUrl();
        return $this->redirect($url);
        $url = $this->adminUrlGenerator
            ->setController(TripCrudController::class)
            ->generateUrl();
        return $this->redirect($url);
        $url = $this->adminUrlGenerator
            ->setController(RatingCrudController::class)
            ->generateUrl();
        $url = $this->adminUrlGenerator
            ->setController(TripRatingCrudController::class)
            ->generateUrl();
        return $this->redirect($url);
        return parent::index();

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
            ->setTitle('RTKMP');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Admin', 'fa fa-home');
        yield MenuItem::linkToCrud('User', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Place', 'fas fa-book fa-fw', Place::class);
        yield MenuItem::linkToCrud('Place Types', 'fas fa-book fa-fw', PlaceType::class);
        yield MenuItem::linkToCrud('Place Cities', 'fas fa-book fa-fw', PlaceCity::class);
        yield MenuItem::linkToCrud('Trip', 'fas fa-map-marker-alt', Trip::class);
        yield MenuItem::linkToCrud('Place ratings', 'fas fa-check', Rating::class);
        yield MenuItem::linkToCrud('Trip ratings', 'fas fa-check', TripRating::class);
    }
}

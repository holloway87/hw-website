<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Frontend controller for Vue.
 *
 * @since 2021.12.07
 */
class FrontendController extends AbstractController
{
    /**
     * Every route that activates the main Vue app.
     *
     * @return Response
     */
    #[Route('/', name: 'frontend_home')]
    #[Route('/admin-login', name: 'frontend_admin_login')]
    #[Route('/illustrations', name: 'frontend_art')]
    #[Route('/illustrations/the-life-of-abe', name: 'frontend_art_the_life_of_abe')]
    #[Route('/illustrations/maaya-community-doodles', name: 'frontend_art_maaya_community_doodles')]
    #[Route('/dev', name: 'frontend_programming')]
    #[Route('/photo-projects', name: 'frontend_photos')]
    #[Route('/photo-projects/analog', name: 'frontend_photos_analog')]
    #[Route('/photo-projects/bw-analog', name: 'frontend_photos_bw_analog')]
    #[Route('/photo-projects/clouds', name: 'frontend_photos_clouds')]
    #[Route('/photo-projects/macro', name: 'frontend_photos_macro')]
    #[Route('/photo-projects/mia', name: 'frontend_photos_mia')]
    #[Route('/timeline', name: 'frontend_timeline')]
    #[Route('/timeline-admin', name: 'frontend_timeline_admin')]
    #[Route('/timeline/{id}', name: 'frontend_timeline_entry', requirements: ['id' => '\d{8}-\d{4}'])]
    public function vue(): Response
    {
        return $this->render('frontend/vue.html.twig');
    }
}

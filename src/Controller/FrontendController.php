<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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
    #[Route('/art', name: 'frontend_art')]
    #[Route('/dev', name: 'frontend_programming')]
    #[Route('/photos', name: 'frontend_photos')]
    public function vue(): Response
    {
        return $this->render('frontend/vue.html.twig');
    }
}

<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Controller to access the images files for the comic The Life of Abe.
 *
 * @since 2022.02.04
 */
class TheLifeOfAbeController extends AbstractController
{
    /**
     * Returns all image files for The Life of Abe comic strips.
     *
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    #[Route('/illustrations/the-life-of-abe/get-image-files', name: 'the_life_of_abe_get_image_files')]
    public function getImageFiles(Request $request): JsonResponse|RedirectResponse
    {
        if (!$request->isXmlHttpRequest()) {
            return $this->redirectToRoute('frontend_art_the_life_of_abe');
        }

        $data = [
            'files' => []
        ];

        $path = __DIR__.'/../../public/art/comic_the_life_of_abe';
        if (!file_exists($path)) {
            return $this->json($data);
        }

        $dir = dir($path);
        while ($file = $dir->read()) {
            if (!preg_match('/\.png$/', $file)) {
                continue;
            }

            $data['files'][] = sprintf('/art/comic_the_life_of_abe/%s', $file);
        }

        return $this->json($data);
    }
}

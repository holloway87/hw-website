<?php declare(strict_types=1);

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Controller to access the images files for Maaya's community doodles.
 *
 * @since 2022.02.04
 */
class MaayaCommunityDoodlesController extends AbstractController
{
    /**
     * Returns all image files for Maaya's community doodles.
     *
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    #[Route('/illustrations/maaya-community-doodles/get-image-files', name: 'maaya_community_doodles_get_image_files')]
    public function getImageFiles(Request $request): JsonResponse|RedirectResponse
    {
        if (!$request->isXmlHttpRequest()) {
            return $this->redirectToRoute('frontend_art_maaya_community_doodles');
        }

        $data = [
            'files' => []
        ];

        $path = __DIR__.'/../../public/art/maaya_community_doodles';
        if (!file_exists($path)) {
            return $this->json($data);
        }

        $dir = dir($path);
        while ($file = $dir->read()) {
            if (!preg_match('/\.(png|gif)$/', $file)) {
                continue;
            }

            $data['files'][] = sprintf('/art/maaya_community_doodles/%s', $file);
        }

        sort($data['files']);

        return $this->json($data);
    }
}

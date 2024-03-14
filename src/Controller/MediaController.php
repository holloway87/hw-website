<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\MediaDirectory;
use App\Entity\MediaFile;
use App\Entity\MediaListRequest;
use App\Form\MediaListType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Controller to manage media files.
 *
 * @since 2024.03.12
 */
class MediaController extends AbstractController
{
    /**
     * List files for the media manager.
     *
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    #[Route('/media-list', name: 'media_list', methods: ['post'])]
    public function listFiles(Request $request): JsonResponse|RedirectResponse
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        if (!$request->isXmlHttpRequest()) {
            return $this->redirectToRoute('frontend_home');
        }

        $list = new MediaListRequest();
        $form = $this->createForm(MediaListType::class, $list);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            return $this->json([
                'success' => true,
                'list' => [
                    'directories' => array_map(function (MediaDirectory $directory) {
                        return $directory->getName();
                    }, $list->getFiles()->getDirectories()),
                    'files' => array_map(function (MediaFile $file) {
                        return $file->getName();
                    }, $list->getFiles()->getFiles()),
                ]
            ]);
        }

        return $this->json([
            'success' => false,
            'no data submitted'
        ]);
    }
}

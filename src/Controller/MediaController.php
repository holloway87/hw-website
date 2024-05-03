<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\MediaDeleteRequest;
use App\Entity\MediaDirectory;
use App\Entity\MediaFile;
use App\Entity\MediaFileUploadRequest;
use App\Entity\MediaListRequest;
use App\Form\MediaDeleteType;
use App\Form\MediaFileUploadType;
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
     * Delete all requested media files.
     *
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    #[Route('/media-delete', name: 'media_delete', methods: ['post'])]
    public function deleteFiles(Request $request): JsonResponse|RedirectResponse
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        if (!$request->isXmlHttpRequest()) {
            return $this->redirectToRoute('frontend_home');
        }

        $delete = new MediaDeleteRequest();
        $form = $this->createForm(MediaDeleteType::class, $delete);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            return $this->json([
                'success' => true
            ]);
        }

        return $this->json([
            'success' => false,
            'no data submitted'
        ]);
    }

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

    /**
     * Uploads a file.
     *
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    #[Route('/media-upload', name: 'media_upload', methods: ['POST'])]
    public function uploadFile(Request $request): JsonResponse|RedirectResponse
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        if (!$request->isXmlHttpRequest()) {
            return $this->redirectToRoute('frontend_home');
        }

        $data = new MediaFileUploadRequest();
        $form = $this->createForm(MediaFileUploadType::class, $data);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            return $this->json([
                'success' => true
            ]);
        }

        return $this->json([
            'success' => false,
            'no data submitted'
        ]);
    }
}

<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\PhotosListRequest;
use App\Form\PhotosListType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Controller to access files for photo projects.
 *
 * @since 2022.03.11
 */
class PhotosController extends AbstractController
{
    /**
     * Returns a file list for a photo project.
     *
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    #[Route('/photos/get-files', methods: ['post'])]
    public function apiList(Request $request): JsonResponse|RedirectResponse
    {
        if (!$request->isXmlHttpRequest()) {
            return $this->redirectToRoute('frontend_photos');
        }

        $list_request = new PhotosListRequest();
        $form = $this->createForm(PhotosListType::class, $list_request);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = [
                'success' => true,
                'files' => []
            ];

            foreach ($list_request->getFiles() as $file) {
                $data['files'][] = [
                    'src' => $file->getFilename(),
                    'thumbnail' => $file->getFilename(),
                    'w' => $file->getWidth(),
                    'h' => $file->getHeight()
                ];
            }

            return $this->json($data);
        }

        return $this->json([
            'success' => false,
            'error' => 'no data submitted'
        ]);
    }
}

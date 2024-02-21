<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\TimelineEntriesRequest;
use App\Entity\TimelineEntryImage;
use App\Form\TimelineEntriesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Controller to access timeline entries.
 *
 * @since 2024.02.20
 */
class TimelineController extends AbstractController
{
    /**
     * Return timeline entries.
     *
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    #[Route('/timeline/entries', methods: ['post'])]
    public function getEntries(Request $request): JsonResponse|RedirectResponse
    {
        if (!$request->isXmlHttpRequest()) {
            return $this->redirectToRoute('frontend_home');
        }

        $entries_request = new TimelineEntriesRequest();
        $form = $this->createForm(TimelineEntriesType::class, $entries_request);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = [
                'success' => true,
                'entries' => []
            ];

            foreach ($entries_request->getEntries() as $entry) {
                $data['entries'][] = [
                    'id' => $entry->getId(),
                    'date' => $entry->getDate()?->format('d.m.y'),
                    'time' => $entry->getDate()?->format('H:i'),
                    'title' => $entry->getTitle(),
                    'content' => $entry->getContent(),
                    'images' => array_map(function (TimelineEntryImage $image) {
                        return [
                            'src' => $image->getUrl(),
                            'thumbnail' => $image->getUrl(),
                            'w' => $image->getWidth(),
                            'h' => $image->getHeight()
                        ];
                    }, $entry->getImages())
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

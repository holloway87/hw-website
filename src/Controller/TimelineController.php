<?php declare(strict_types=1);

namespace App\Controller;

use App\Component\TimelineComponent;
use App\Entity\TimelineEntriesRequest;
use App\Entity\TimelineEntryImage;
use App\Form\TimelineEntriesType;
use App\Form\TimelineEntryEditType;
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
     * Creates a new timeline entry and returns the id.
     *
     * @param Request $request
     * @param TimelineComponent $timeline
     * @return JsonResponse|RedirectResponse
     */
    #[Route('/timeline-admin/create', methods: ['post'])]
    public function createEntry(Request $request, TimelineComponent $timeline)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        if (!$request->isXmlHttpRequest()) {
            return $this->redirectToRoute('frontend_home');
        }

        $id = $timeline->createEntry();

        return $this->json([
            'success' => true,
            'id' => $id
        ]);
    }

    /**
     * Deletes the timeline entry.
     *
     * @param Request $request
     * @param TimelineComponent $timeline
     * @param string $id
     * @return JsonResponse|RedirectResponse
     * @throws \Exception
     */
    #[Route('/timeline-admin/delete-{id}', requirements: ['id' => '\d{8}-\d{4}'], methods: ['post'])]
    public function deleteEntry(Request $request, TimelineComponent $timeline, string $id)
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        if (!$request->isXmlHttpRequest()) {
            return $this->redirectToRoute('frontend_home');
        }

        $entry = $timeline->retrieveEntry($id);
        if (!$entry) {
            return $this->json([
                'success' => false,
                'error' => 'the timeline entry could not be found'
            ]);
        }

        $timeline->deleteEntry($entry);

        return $this->json([
            'success' => true
        ]);
    }

    /**
     * Edit a timeline entry.
     *
     * @param Request $request
     * @param TimelineComponent $timeline
     * @param string $id
     * @return JsonResponse|RedirectResponse
     * @throws \Exception
     */
    #[Route('/timeline-admin/edit-{id}', requirements: ['id' => '\d{8}-\d{4}'], methods: ['post'])]
    public function editEntry(Request $request, TimelineComponent $timeline, string $id): JsonResponse|RedirectResponse
    {
        $this->denyAccessUnlessGranted('ROLE_USER');

        if (!$request->isXmlHttpRequest()) {
            return $this->redirectToRoute('frontend_home');
        }

        $entry = $timeline->retrieveEntry($id);
        if (!$entry) {
            return $this->json([
                'success' => false,
                'error' => 'the timeline entry could not be found'
            ]);
        }

        $form = $this->createForm(TimelineEntryEditType::class, $entry);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            return $this->json([
                'success' => true
            ]);
        }

        return $this->json([
            'success' => false,
            'error' => 'no data submitted'
        ]);
    }

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

<?php declare(strict_types=1);

namespace App\Controller;

use App\Component\TimelineComponent;
use App\Entity\TimelineEntriesRequest;
use App\Entity\TimelineEntryImage;
use App\Form\TimelineEntriesType;
use App\Form\TimelineEntryEditType;
use FeedIo\Adapter\NullClient;
use FeedIo\Feed;
use FeedIo\Feed\Item\Media;
use FeedIo\FeedIo;
use Psr\Log\NullLogger;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

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
    public function createEntry(
        Request $request,
        TimelineComponent $timeline
    ): JsonResponse|RedirectResponse {
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
    public function deleteEntry(
        Request $request,
        TimelineComponent $timeline,
        string $id
    ): JsonResponse|RedirectResponse {
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
    public function editEntry(
        Request $request,
        TimelineComponent $timeline,
        string $id
    ): JsonResponse|RedirectResponse {
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
     * Generate an atom feed for the timeline entries.
     *
     * @param TimelineComponent $timeline
     * @return Response
     */
    #[Route('/timeline/feed')]
    public function feed(TimelineComponent $timeline): Response
    {
        $feedIo = new FeedIo(new NullClient(), new NullLogger());

        $feed = new Feed;
        $feed->setTitle('hw-web Timeline');
        $feed->setLink($this->generateUrl('frontend_timeline', [], UrlGeneratorInterface::ABSOLUTE_URL));
        $feed->setDescription('See what happens in my life, what I see around me with photos, or anything else.');

        $timlineRequest = new TimelineEntriesRequest();
        $timeline->retrieveEntries($timlineRequest);
        foreach ($timlineRequest->getEntries() as $entry) {
            $feedEntry = $feed->newItem();

            $content = $entry->getContent();
            if ($entry->getImages()) {
                foreach ($entry->getImages() as $image) {
                    $media = new Media;
                    $media->setUrl(rtrim($this->generateUrl('frontend_home', [], UrlGeneratorInterface::ABSOLUTE_URL), '/').$image->getUrl())
                        ->setType($image->getMimeType() ?: '');
                    $feedEntry->addMedia($media);

                    $content .= sprintf(
                        '<p><img src="%s" width="%d" height="%d"></p>',
                        rtrim($this->generateUrl('frontend_home', [], UrlGeneratorInterface::ABSOLUTE_URL), '/').$image->getUrl(),
                        $image->getWidth(),
                        $image->getHeight(),
                    );
                }
            }

            $feedEntry->setTitle($entry->getTitle() ?: $entry->getDate()->format('d.m.Y H:i'));
            $feedEntry->setContent($content);
            $feedEntry->setLink($this->generateUrl(
                'frontend_timeline_entry',
                ['id' => $entry->getId()],
                UrlGeneratorInterface::ABSOLUTE_URL,
            ));
            $feedEntry->setLastModified($entry->getDate());
            $feed->add($feedEntry);
        }

        return new Response($feedIo->toAtom($feed), 200, ['Content-Type' => 'application/atom+xml']);
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

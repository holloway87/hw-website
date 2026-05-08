<?php declare(strict_types=1);

namespace App\Controller;

use App\Entity\BlogListRequest;
use App\Form\BlogListType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

/**
 * Controller for the blog.
 *
 * @since 2026.01.08
 */
class BlogController extends AbstractController
{
    /**
     * Get all blog entries.
     *
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    #[Route('/blog/get-entries', methods: ['post'])]
    public function list(Request $request): JsonResponse|RedirectResponse
    {
        if (!$request->isXmlHttpRequest()) {
            return $this->redirectToRoute('frontend_blog');
        }

        $list_request = new BlogListRequest();
        $form = $this->createForm(BlogListType::class, $list_request);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = [
                'success' => true,
                'entries' => [],
            ];

            foreach ($list_request->entries as $entry) {
                $data['entries'][] = [
                    'title' => $entry->title,
                    'content' => $entry->content,
                    'created' => $entry->created->format(\DateTimeInterface::RFC3339),
                    'date' => $entry->created->format('d.m.y'),
                    'link' => $this->generateUrl('frontend_blog_entry', ['slug' => $entry->slug]),
                    'time' => $entry->created->format('H:i'),
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

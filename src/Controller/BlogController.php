<?php declare(strict_types=1);

namespace App\Controller;

use App\Component\BlogComponent;
use App\Component\HtmlMeta;
use App\Entity\BlogEntry;
use App\Entity\BlogListRequest;
use App\Entity\OpenGraphData;
use App\Form\BlogListType;
use App\Markdown\MarkdownSanitizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\ValueResolver;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

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
                    'date' => $entry->date,
                    'link' => $entry->link,
                    'time' => $entry->time,
                ];
            }

            return $this->json($data);
        }

        return $this->json([
            'success' => false,
            'error' => 'no data submitted'
        ]);
    }

    /**
     * View to list all blog entries.
     *
     * @param BlogComponent $blog
     * @param HtmlMeta $html_meta
     * @return Response
     */
    #[Route('/blog', name: 'blog_list')]
    public function listEntries(
        BlogComponent $blog,
        HtmlMeta $html_meta,
    ): Response {
        $request = new BlogListRequest;
        $blog->listEntries($request);

        $html_meta->back_url = $this->generateUrl('frontend_home');
        $html_meta->title = 'Blog - hw-web';

        return $this->render('blog/list_entries.html.twig', [
            'entries' => $request->entries,
        ]);
    }

    /**
     * View for a blog entry.
     *
     * @param BlogEntry $blog_entry
     * @return Response
     */
    #[Route('/blog/{blog_entry}', name: 'blog_entry', requirements: ['blog_entry' => '[^/\?]+'])]
    public function listEntry(
        HtmlMeta $html_meta,
        #[ValueResolver('blog_entry')] BlogEntry $blog_entry,
    ): Response {
        $html_meta->back_url = $this->generateUrl('frontend_blog');
        $html_meta->title = 'Blog - '.$blog_entry->title.' - hw-web';
        $html_meta->open_graph = new OpenGraphData;
        $html_meta->open_graph->locale = 'en_US';
        $html_meta->open_graph->type = 'article';
        $html_meta->open_graph->title = $blog_entry->title;
        $html_meta->open_graph->description = MarkdownSanitizer::sanitize($blog_entry->content);
        $html_meta->open_graph->article_published_time = $blog_entry->created;
        $html_meta->open_graph->site_name = 'hw-web';
        $html_meta->open_graph->url = $this->generateUrl('blog_entry', ['blog_entry' => $blog_entry->slug], UrlGeneratorInterface::ABSOLUTE_URL);

        return $this->render('blog/list_entry.html.twig', [
            'blog_entry' => $blog_entry,
        ]);
    }
}

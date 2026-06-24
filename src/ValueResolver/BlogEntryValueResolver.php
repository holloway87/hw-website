<?php declare(strict_types=1);

namespace App\ValueResolver;

use App\Component\BlogComponent;
use App\Entity\BlogEntry;
use App\Entity\BlogListRequest;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsTargetedValueResolver;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Value resolver for {@see BlogEntry}.
 *
 * @since 2026.06.24
 */
#[AsTargetedValueResolver('blog_entry')]
class BlogEntryValueResolver implements ValueResolverInterface
{
    /**
     * Set all necessary services.
     *
     * @param BlogComponent $blog
     */
    public function __construct(private readonly BlogComponent $blog) {}

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $argumentType = $argument->getType();
        if (BlogEntry::class !== $argumentType) {
            return [];
        }

        $value = $request->attributes->get($argument->getName());
        if (!\is_string($value)) {
            return [];
        }

        $listRequest = new BlogListRequest();
        $listRequest->slug = $value;
        $this->blog->listEntries($listRequest);

        if (!$listRequest->entries) {
            throw new NotFoundHttpException(\sprintf('The blog entry "%s" could not be found.', $value));
        }

        return $listRequest->entries;
    }
}

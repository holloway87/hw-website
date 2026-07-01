<?php declare(strict_types=1);

namespace App\ValueResolver;

use App\Component\TimelineComponent;
use App\Entity\TimelineEntry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Attribute\AsTargetedValueResolver;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;
use Symfony\Component\HttpKernel\Controller\ValueResolverInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Value resolver for {@see TimelineEntry}.
 *
 * @since 2026.07.01
 */
#[AsTargetedValueResolver('timeline_entry')]
class TimelineEntryValueResolver implements ValueResolverInterface
{
    /**
     * Set all necessary services.
     *
     * @param TimelineComponent $timeline
     */
    public function __construct(private readonly TimelineComponent $timeline) {}

    public function resolve(Request $request, ArgumentMetadata $argument): iterable
    {
        $argumentType = $argument->getType();
        if (TimelineEntry::class !== $argumentType) {
            return [];
        }

        $value = $request->attributes->get($argument->getName());
        if (!\is_string($value)) {
            return [];
        }

        $entry = $this->timeline->retrieveEntry($value);
        if (!$entry) {
            throw new NotFoundHttpException(\sprintf('The timeline entry "%s" could not be found.', $value));
        }

        return [$entry];
    }
}

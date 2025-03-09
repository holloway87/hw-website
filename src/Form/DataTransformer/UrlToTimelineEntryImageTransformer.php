<?php declare(strict_types=1);

namespace App\Form\DataTransformer;

use App\Entity\TimelineEntryImage;
use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

/**
 * Transformer for {@see TimelineEntryImage} to URL and vice versa.
 *
 * @since 2025.03.09
 */
class UrlToTimelineEntryImageTransformer implements DataTransformerInterface
{
    /**
     * Transforms a {@see TimelineEntryImage} object to a URL.
     *
     * @param TimelineEntryImage|null $value
     * @return string|null
     */
    public function transform($value): ?string
    {
        if (null === $value) {
            return null;
        }

        if (!$value instanceof TimelineEntryImage) {
            throw new TransformationFailedException('Expected a '.TimelineEntryImage::class.' object.');
        }

        return $value->getUrl();
    }

    /**
     * Transforms a URL into a {@see TimelineEntryImage} object.
     *
     * @param string|null $value
     * @return TimelineEntryImage|null
     */
    public function reverseTransform($value): ?TimelineEntryImage
    {
        if (null === $value || '' === $value) {
            return null;
        }

        return new TimelineEntryImage()
            ->setUrl($value);
    }
}

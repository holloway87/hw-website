<?php declare(strict_types=1);

namespace App\Form;

use App\Entity\TimelineEntryImage;
use App\Form\DataTransformer\UrlToTimelineEntryImageTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * Form type for a {@see TimelineEntryImage}.
 *
 * Only the URL is needed as form data.
 *
 * @since 2025.03.09
 */
class TimelineEntryImageType extends AbstractType
{
    /**
     * Set all needed services.
     *
     * @param UrlToTimelineEntryImageTransformer $transformer
     */
    public function __construct(private readonly UrlToTimelineEntryImageTransformer $transformer)
    {}

    /**
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addModelTransformer($this->transformer); // Ensure transformation
    }

    /**
     */
    public function getParent(): string
    {
        return TextType::class;
    }
}

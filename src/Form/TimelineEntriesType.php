<?php declare(strict_types=1);

namespace App\Form;

use App\Component\TimelineComponent;
use App\Entity\TimelineEntriesRequest;
use App\Form\EventListener\TimelineEntriesSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form to retrieve timeline entries.
 *
 * @since 2024.02.20
 */
class TimelineEntriesType extends AbstractType
{
    /**
     * Set all needed services.
     *
     * @param TimelineComponent $timeline
     */
    public function __construct(private readonly TimelineComponent $timeline) {}

    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('limit', NumberType::class, [
                'required' => false
            ])
            ->addEventSubscriber(new TimelineEntriesSubscriber($this->timeline));
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'csrf_protection' => false,
            'data_class' => TimelineEntriesRequest::class
        ]);
    }

    /**
     * @inheritDoc
     */
    public function getBlockPrefix(): string
    {
        return '';
    }
}

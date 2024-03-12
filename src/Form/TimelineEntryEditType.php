<?php declare(strict_types=1);

namespace App\Form;

use App\Component\TimelineComponent;
use App\Entity\TimelineEntry;
use App\Form\EventListener\TimelineEntryEditSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form to edit a timeline entry.
 *
 * @since 2024.03.12
 */
class TimelineEntryEditType extends AbstractType
{
    /**
     * Set all needed services.
     *
     * @param TimelineComponent $timeline
     */
    public function __construct(private readonly TimelineComponent $timeline) {}

    /**
     */
    #[\Override]
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'required' => false,
            ])
            ->add('content', TextareaType::class, [
                'required' => false
            ])
            ->addEventSubscriber(new TimelineEntryEditSubscriber($this->timeline));
    }

    /**
     */
    #[\Override]
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'csrf_protection' => false,
            'data_class' => TimelineEntry::class
        ]);
    }

    /**
     */
    #[\Override]
    public function getBlockPrefix(): string
    {
        return '';
    }
}

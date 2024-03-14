<?php declare(strict_types=1);

namespace App\Form;

use App\Component\MediaComponent;
use App\Entity\MediaListRequest;
use App\Form\EventListener\MediaListSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form to list media directories and files.
 *
 * @since 2024.03.12
 */
class MediaListType extends AbstractType
{
    /**
     * Set all needed components.
     *
     * @param MediaComponent $media
     */
    public function __construct(private readonly MediaComponent $media) {}

    /**
     */
    #[\Override]
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('path', TextType::class, [
                'required' => true
            ])
            ->addEventSubscriber(new MediaListSubscriber($this->media));
    }

    /**
     */
    #[\Override]
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'csrf_protection' => false,
            'data_class' => MediaListRequest::class
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

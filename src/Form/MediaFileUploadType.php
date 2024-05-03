<?php

namespace App\Form;

use App\Component\MediaComponent;
use App\Entity\MediaFileUploadRequest;
use App\Form\EventListener\MediaFileUploadSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form type to upload a media file.
 *
 * @since 2024.03.14
 */
class MediaFileUploadType extends AbstractType
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
            ->add('file', FileType::class, [
                'required' => true
            ])
            ->addEventSubscriber(new MediaFileUploadSubscriber($this->media));
    }

    /**
     */
    #[\Override]
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'csrf_protection' => false,
            'data_class' => MediaFileUploadRequest::class
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

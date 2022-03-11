<?php declare(strict_types=1);

namespace App\Form;

use App\Component\PhotosComponent;
use App\Entity\PhotosListRequest;
use App\Form\EventListener\PhotosListSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form to list files for a photo project.
 *
 * @since 2022.03.11
 */
class PhotosListType extends AbstractType
{
    /**
     * Set all needed services.
     *
     * @param PhotosComponent $photos_component
     */
    public function __construct(private PhotosComponent $photos_component) {}

    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('project', TextType::class, [
                'required' => true
            ])
            ->addEventSubscriber(new PhotosListSubscriber($this->photos_component));
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'csrf_protection' => false,
            'data_class' => PhotosListRequest::class
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

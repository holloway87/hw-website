<?php declare(strict_types=1);

namespace App\Form;

use App\Component\BlogComponent;
use App\Entity\BlogListRequest;
use App\Form\EventListener\BlogListSubscriber;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Form to list entries for the blog.
 *
 * @since 2026.01.08
 */
class BlogListType extends AbstractType
{
    /**
     * Set all needed services.
     *
     * @param BlogComponent $blog_component
     */
    public function __construct(private BlogComponent $blog_component) {}

    /**
     * @inheritDoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('limit', NumberType::class, [
                'empty_data' => 0,
                'required' => false,
            ])
            ->add('slug', TextType::class, [
                'empty_data' => '',
                'required' => false,
            ])
            ->addEventSubscriber(new BlogListSubscriber($this->blog_component));
    }

    /**
     * @inheritDoc
     */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'csrf_protection' => false,
            'data_class' => BlogListRequest::class
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

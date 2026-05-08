<?php declare(strict_types=1);

namespace App\Form\EventListener;

use App\Component\BlogComponent;
use App\Entity\BlogListRequest;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Event\PostSubmitEvent;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Form\FormEvents;

/**
 * Subscriber to list entries for the blog.
 *
 * @since 2026.01.08
 */
class BlogListSubscriber implements EventSubscriberInterface
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
    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::POST_SUBMIT => 'processForm'
        ];
    }

    /**
     * Processes the form.
     *
     * @param PostSubmitEvent $event
     */
    public function processForm(PostSubmitEvent $event): void
    {
        $request = $event->getData();
        if (!($request instanceof BlogListRequest)) {
            throw new UnexpectedTypeException($request, BlogListRequest::class);
        }

        if (!$event->getForm()->isValid()) {
            return;
        }

        $this->blog_component->listEntries($request);
    }
}

<?php declare(strict_types=1);

namespace App\Form\EventListener;

use App\Component\MediaComponent;
use App\Entity\MediaListRequest;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Event\PostSubmitEvent;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Form\FormEvents;

/**
 * Subscriber to list media directories and files.
 *
 * @since 2024.03.12
 */
readonly class MediaListSubscriber implements EventSubscriberInterface
{
    /**
     * Set all needed components.
     *
     * @param MediaComponent $media
     */
    public function __construct(private MediaComponent $media) {}

    /**
     */
    #[\Override]
    public static function getSubscribedEvents(): array
    {
        return [
            FormEvents::POST_SUBMIT => 'processForm'
        ];
    }

    /**
     * Process the form.
     *
     * @param PostSubmitEvent $event
     * @return void
     */
    public function processForm(PostSubmitEvent $event): void
    {
        $request = $event->getData();
        if (!($request instanceof MediaListRequest)) {
            throw new UnexpectedTypeException($request, MediaListRequest::class);
        }

        if (!$event->getForm()->isValid()) {
            return;
        }

        $this->media->list($request);
    }
}

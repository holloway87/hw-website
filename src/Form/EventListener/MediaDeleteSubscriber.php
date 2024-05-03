<?php declare(strict_types=1);

namespace App\Form\EventListener;

use App\Component\MediaComponent;
use App\Entity\MediaDeleteRequest;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Event\PostSubmitEvent;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Form\FormEvents;

/**
 * Subscriber to delete media files.
 *
 * @since 2024.05.03
 */
readonly class MediaDeleteSubscriber implements EventSubscriberInterface
{
    /**
     * Set all needed components.
     *
     * @param MediaComponent $media
     */
    public function __construct(private MediaComponent $media) {}

    /**
     */
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
        if (!($request instanceof MediaDeleteRequest)) {
            throw new UnexpectedTypeException($request, MediaDeleteRequest::class);
        }

        if (!$event->getForm()->isValid()) {
            return;
        }

        $this->media->deleteFiles($request);
    }
}

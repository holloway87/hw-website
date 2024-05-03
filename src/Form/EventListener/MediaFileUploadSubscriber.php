<?php declare(strict_types=1);

namespace App\Form\EventListener;

use App\Component\MediaComponent;
use App\Entity\MediaFileUploadRequest;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Event\PostSubmitEvent;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Form\FormEvents;

/**
 * Subscriber to upload a media file.
 *
 * @since 2024.03.14
 */
readonly class MediaFileUploadSubscriber implements EventSubscriberInterface
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
        if (!($request instanceof MediaFileUploadRequest)) {
            throw new UnexpectedTypeException($request, MediaFileUploadRequest::class);
        }

        if (!$event->getForm()->isValid()) {
            return;
        }

        $this->media->upload($request);
    }
}

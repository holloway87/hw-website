<?php declare(strict_types=1);

namespace App\Form\EventListener;

use App\Component\PhotosComponent;
use App\Entity\PhotosListRequest;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Event\PostSubmitEvent;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Form\FormEvents;

/**
 * Subscriber to list files for a photo project.
 *
 * @since 2022.03.11
 */
class PhotosListSubscriber implements EventSubscriberInterface
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
        if (!($request instanceof PhotosListRequest)) {
            throw new UnexpectedTypeException($request, PhotosListRequest::class);
        }

        if (!$event->getForm()->isValid()) {
            return;
        }

        $this->photos_component->listPhotos($request);
    }
}

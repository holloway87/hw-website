<?php declare(strict_types=1);

namespace App\Form\EventListener;

use App\Component\TimelineComponent;
use App\Entity\TimelineEntriesRequest;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Event\PostSubmitEvent;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Form\FormEvents;

/**
 * Subscriber to retrieve timeline entries.
 *
 * @since 2024.02.20
 */
readonly class TimelineEntriesSubscriber implements EventSubscriberInterface
{
    /**
     * Set all needed services.
     *
     * @param TimelineComponent $timeline
     */
    public function __construct(private TimelineComponent $timeline) {}

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
     * @throws \Exception
     */
    public function processForm(PostSubmitEvent $event): void
    {
        $request = $event->getData();
        if (!($request instanceof TimelineEntriesRequest)) {
            throw new UnexpectedTypeException($request, TimelineEntriesRequest::class);
        }

        if (!$event->getForm()->isValid()) {
            return;
        }

        $this->timeline->retrieveEntries($request);
    }
}

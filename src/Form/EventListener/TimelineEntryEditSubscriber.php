<?php declare(strict_types=1);

namespace App\Form\EventListener;

use App\Component\TimelineComponent;
use App\Entity\TimelineEntry;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\Event\PostSubmitEvent;
use Symfony\Component\Form\Exception\UnexpectedTypeException;
use Symfony\Component\Form\FormEvents;

/**
 * Subscriber to edit a timeline entry.
 *
 * @since 2024.03.12
 */
readonly class TimelineEntryEditSubscriber implements EventSubscriberInterface
{
    /**
     * Set all needed services.
     *
     * @param TimelineComponent $timeline
     */
    public function __construct(private TimelineComponent $timeline) {}

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
        $entry = $event->getData();
        if (!($entry instanceof TimelineEntry)) {
            throw new UnexpectedTypeException($entry, TimelineEntry::class);
        }

        if (!$event->getForm()->isValid()) {
            return;
        }

        $this->timeline->saveEntry($entry);
    }
}

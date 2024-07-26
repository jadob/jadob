<?php
declare(strict_types=1);

namespace Jadob\EventStore\Extension;

use Jadob\Aggregate\AggregateRootInterface;
use Jadob\Aggregate\DomainEventInterface;
use Jadob\EventStore\AggregateMetadata;
use Jadob\EventStore\EventStoreExtensionInterface;

class EventHashExtension implements EventStoreExtensionInterface
{
    public const ATTRIBUTE = 'hash';

    /**
     * {@inheritDoc}
     */
    #[\Override]
    public function onAggregateCreate(AggregateRootInterface $aggregate, AggregateMetadata $metadata): void
    {
        // TODO: Implement onAggregateCreate() method.
    }

    /**
     * {@inheritDoc}
     */
    #[\Override]
    public function onEventAppend(DomainEventInterface $event, string $payload, AggregateRootInterface $aggregate): void
    {
        $event->addAttribute(
            self::ATTRIBUTE,
            $this->calculateEventHash(
                $payload,
                $aggregate->getAggregateId(),
                $event->getEventId()
            )
        );
    }

    public function calculateEventHash(string $payload, string $aggregateId, string $eventId): string
    {
        return hash('sha256', sprintf('%s.%s.%s', $payload, $aggregateId, $eventId));
    }
}
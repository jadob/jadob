<?php
declare(strict_types=1);

namespace Jadob\EventSourcing\EventStore\Extension;

use Jadob\EventSourcing\Aggregate\AggregateRootInterface;
use Jadob\EventSourcing\Aggregate\DomainEventInterface;
use Jadob\EventSourcing\EventStore\AggregateMetadata;
use Jadob\EventSourcing\EventStore\EventStoreExtensionInterface;

class EventHashExtension implements EventStoreExtensionInterface
{
    public const ATTRIBUTE = 'hash';

    /**
     * @inheritDoc
     */
    public function onAggregateCreate(AggregateRootInterface $aggregate, AggregateMetadata $metadata): void
    {
        // TODO: Implement onAggregateCreate() method.
    }


    /**
     * @inheritDoc
     */
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
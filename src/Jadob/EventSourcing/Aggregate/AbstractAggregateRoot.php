<?php

declare(strict_types=1);

namespace Jadob\EventSourcing\Aggregate;

use Jadob\EventSourcing\AbstractDomainEvent;
use ReflectionClass;
use ReflectionException;
use function get_called_class;

/**
 * Base class for aggregate roots.
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
abstract class AbstractAggregateRoot
{
    /**
     * @var int
     */
    private $aggregateVersion = 0;

    /**
     * @var AbstractDomainEvent[]
     */
    protected $recordedEvents = [];

    /**
     * @var string
     */
    private $aggregateId;

    /**
     *
     * @param string $aggregateId
     * @param int $version
     * @param array $events
     * @return AbstractAggregateRoot
     * @throws ReflectionException
     */
    public static function recreate(string $aggregateId, int $version, array $events): AbstractAggregateRoot
    {
        $reflection = new ReflectionClass(get_called_class());
        /** * @var AbstractAggregateRoot $self */
        $self = $reflection->newInstanceWithoutConstructor();
        $self->aggregateId = $aggregateId;
        $self->aggregateVersion = $version;

        foreach ($events as $event) {
            /** @var AbstractDomainEvent $event */
            $event->setAggregateId($aggregateId);
            $event->setAggregateVersion($event['_version']);
            unset($event['_version']);
            $self->apply($event);
        }

        return $self;
    }

    /**
     * Modifies the state of aggregate.
     * @param object $event received from recordThat() or while aggregate reconstitution
     */
    abstract protected function apply(object $event): void;

    /**
     * @return string
     */
    public function getAggregateId(): string
    {
        return $this->aggregateId;
    }

    /**
     * @return AbstractDomainEvent[]
     */
    public function popUncomittedEvents(): array
    {
        $events = $this->recordedEvents;
        $this->recordedEvents = [];
        return $events;
    }

    /**
     * @param object $event
     */
    final protected function recordThat(object $event): void
    {
        $this->aggregateVersion++;
        $this->recordedEvents[$this->aggregateVersion] = $event;

        if ($event instanceof AbstractDomainEvent) {
            $event->setAggregateId($this->getAggregateId());
            $event->setAggregateVersion($this->aggregateVersion);
        }

        $this->apply($event); //send to apply() so user can handle the state change
    }

}
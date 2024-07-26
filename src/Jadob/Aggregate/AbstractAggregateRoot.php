<?php

declare(strict_types=1);

namespace Jadob\Aggregate;

use DateTime;
use DateTimeInterface;
use Exception;
use Jadob\EventSourcing\AbstractDomainEvent;
use Ramsey\Uuid\Uuid;
use ReflectionClass;
use ReflectionException;

/**
 * Base class for aggregate roots.
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
abstract class AbstractAggregateRoot implements AggregateRootInterface
{
    /**
     * Fresh Aggregate does not have any events applied.
     * Version will be bumped with each event recored (@see AbstractAggregateRoot::recordThat())
     * @var int
     */
    private int $aggregateVersion = 0;

    /**
     * @var DomainEventInterface[]
     */
    protected array $recordedEvents = [];
    protected array $events = [];

    /**
     * @var string
     */
    private string $aggregateId;

    private DateTimeInterface $createdAt;

    /**
     * Use this in your aggregates to warm your object quickly.
     * @throws Exception
     */
    protected function __construct()
    {
//        @trigger_error(
//            'Calling constructor of AbstractAggregateRoot is deprecated, use assignAggregateId and assignRecordTimestamp instead.',
//            E_USER_DEPRECATED
//        );
        $this->assignAggregateId();
        $this->assignRecordTimestamp();
    }


    public function assignAggregateId()
    {
        $this->aggregateId = Uuid::uuid4()->toString();
    }
    protected function assignRecordTimestamp()
    {
        $this->createdAt = new DateTime();
    }

    /**
     *
     * @param string $aggregateId
     * @param int $version
     * @param array $events
     * @return AbstractAggregateRoot
     * @throws ReflectionException
     */
    #[\Override]
    public static function recreate(string $aggregateId, int $version, array $events): AbstractAggregateRoot
    {
        $reflection = new ReflectionClass(static::class);
        /** * @var AbstractAggregateRoot $self */
        $self = $reflection->newInstanceWithoutConstructor();
        $self->aggregateId = $aggregateId;
        $self->aggregateVersion = $version;

        foreach ($events as $event) {
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
    #[\Override]
    public function getAggregateId(): string
    {
        return $this->aggregateId;
    }

    /**
     * @return AbstractDomainEvent[]
     */
    #[\Override]
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
        $this->bumpAggregateVersion();
        $aggrVersion = $this->getAggregateVersion();
        $this->recordedEvents[(string) $aggrVersion] = $event;

        if ($event instanceof DomainEventInterface) {
            $event->assignAggregateId($this->getAggregateId());
            $event->assignEventNumber($aggrVersion);

        }

        $this->apply($event); //send to apply() so user can handle the state change
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }


    abstract protected function bumpAggregateVersion(): void;

    abstract protected function getAggregateVersion(): int;
}

<?php

declare(strict_types=1);

namespace Jadob\Aggregate;

use DateTimeImmutable;
use DateTimeInterface;
use Override;
use Ulid\Ulid;

/**
 * Base class for domain events in aggregate roots.
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
abstract class AbstractDomainEvent implements DomainEventInterface
{
    protected int $aggregateVersion;
    protected string $aggregateId;
    protected string $eventId;
    protected DateTimeInterface $recordedAt;
    protected array $attributes = [];


    protected function assignEventId()
    {
        $this->eventId = (string) Ulid::generate();
    }

    protected function assignRecordTimestamp()
    {
        $this->recordedAt = new DateTimeImmutable();
    }

    /**
     * @deprecated
     * AbstractDomainEvent constructor.
     */
    public function __construct()
    {
//        @trigger_error(
//            'Calling constructor of AbstractDomainEvent is deprecated, use assignEventId and assignRecordTimestamp instead.',
//            E_USER_DEPRECATED
//        );
        $this->assignEventId();
        $this->assignRecordTimestamp();
    }

    public function setAggregateId(string $aggregateId): void
    {
        $this->aggregateId = $aggregateId;
    }


    public function setAggregateVersion(int $version): void
    {
        $this->aggregateVersion = $version;
    }


    public function getAggregateId(): string
    {
        return $this->aggregateId;
    }


    public function getAggregateVersion(): int
    {
        return $this->aggregateVersion;
    }

    /**
     * @return DateTimeInterface
     */
    public function recordedAt(): DateTimeInterface
    {
        return $this->recordedAt;
    }

    #[Override]
    public function getEventId(): string
    {
        return $this->eventId;
    }

    #[Override]
    public function addAttribute(string $name, string $value): void
    {
        $this->attributes[$name] = $value;
    }

    #[Override]
    public function getAttributes(): array
    {
        return $this->attributes;
    }
}
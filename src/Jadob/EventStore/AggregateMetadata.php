<?php
declare(strict_types=1);


namespace Jadob\EventStore;

use DateTimeInterface;

class AggregateMetadata
{
    public function __construct(private readonly string $aggregateId, private readonly string $aggregateType, private readonly DateTimeInterface $createdAt)
    {
    }

    /**
     * @return string
     */
    public function getAggregateId(): string
    {
        return $this->aggregateId;
    }

    /**
     * @return string
     */
    public function getAggregateType(): string
    {
        return $this->aggregateType;
    }

    /**
     * @return DateTimeInterface
     */
    public function getCreatedAt(): DateTimeInterface
    {
        return $this->createdAt;
    }
}
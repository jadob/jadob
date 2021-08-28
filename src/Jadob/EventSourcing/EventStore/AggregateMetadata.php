<?php


namespace Jadob\EventSourcing\EventStore;


class AggregateMetadata
{


    private string $aggregateId;
    private string $aggregateType;
    private \DateTimeInterface $createdAt;

    public function __construct(string $aggregateId, string $aggregateType, \DateTimeInterface $createdAt)
    {

        $this->aggregateId = $aggregateId;
        $this->aggregateType = $aggregateType;
        $this->createdAt = $createdAt;
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
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }


}
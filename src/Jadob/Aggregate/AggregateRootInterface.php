<?php
declare(strict_types=1);

namespace Jadob\Aggregate;

interface AggregateRootInterface
{
    /**
     * @return DomainEventInterface[]
     */
    public function popUncomittedEvents(): array;
    public static function recreate(string $aggregateId, int $version, array $events): self;
    public function getAggregateId(): string;
}
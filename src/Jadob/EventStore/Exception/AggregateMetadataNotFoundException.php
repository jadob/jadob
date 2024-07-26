<?php
declare(strict_types=1);


namespace Jadob\EventStore\Exception;

class AggregateMetadataNotFoundException extends EventStoreException
{
    public static function for(string $aggregateId)
    {
        return new self(sprintf('Could not find metadata for aggregate with id %s', $aggregateId));
    }
}
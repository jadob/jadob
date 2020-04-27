<?php
declare(strict_types=1);

namespace Jadob\EventSourcing\EventStore;

use Jadob\EventSourcing\AbstractDomainEvent;
use Jadob\EventSourcing\Aggregate\AbstractAggregateRoot;

/**
 * Allows to store events in Amazon DynamoDB service.
 * AWS SDK v3.133 at least required.
 *
 * Warning:
 * This implementation assumes that your event store table has:
 * - Primary Key (PK) with type STRING (default name: "aggregateId")
 * - Sort Key (SK) with type STRING (default name: "eventId")
 *
 *
 * Also, metadata store table has given requirements:
 * - Primary Key (PK) with type STRING (default name: "aggregateId")
 * - Sort Key (SK) with type STRING (default name: "aggregateType")
 *
 * These two tables above, represented in aws-cdk:
 *
 * import dynamodb = require('@aws-cdk/aws-dynamodb');
 *
 * new dynamodb.Table(this, 'events-table', {
 *          partitionKey: {
 *              name: 'aggregateId',
 *              type: dynamodb.AttributeType.STRING
 *          },
 *          sortKey: {
 *              name: 'eventType',
 *              type: dynamodb.AttributeType.NUMBER
 *          },
 *  });
 *
 * new dynamodb.Table(this, 'metadata-table', {
 *          partitionKey: {
 *              name: 'aggregateId',
 *              type: dynamodb.AttributeType.STRING
 *          },
 *          sortKey: {
 *              name: 'aggregateType',
 *              type: dynamodb.AttributeType.NUMBER
 *          },
 *  });
 *
 * Field names can be overriden:
 * $config['store_pk_name'] = 'yourPrimaryKeyName';
 * $config['store_sk_name'] = 'yourPrimaryKeyName';
 * $config['metadata_pk_name'] = 'yourPrimaryKeyName';
 * $config['metadata_sk_name'] = 'yourPrimaryKeyName';
 *
 * $store = new DynamoDbEventStore([...], $config);
 *
 * @see https://aws.amazon.com/dynamodb/
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class DynamoDBEventStore implements EventStoreInterface
{

    /**
     * @param AbstractAggregateRoot $aggregateRoot
     * @return void
     */
    public function saveAggregateRoot(AbstractAggregateRoot $aggregateRoot)
    {
        // TODO: Implement saveAggregateRoot() method.
    }

    /**
     * @TODO   refactor name
     * @param string $streamName
     * @return AbstractDomainEvent[]
     */
    public function getStream(string $streamName): array
    {
        // TODO: Implement getStream() method.
    }
}
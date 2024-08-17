<?php
declare(strict_types=1);


namespace Jadob\EventStore;

use Aws\DynamoDb\DynamoDbClient;
use Aws\DynamoDb\Marshaler;
use DateTimeInterface;
use Jadob\Aggregate\AggregateRootInterface;
use Jadob\EventStore\DynamoDb\AttributeName;
use Jadob\EventStore\DynamoDb\EventStoreTableConfiguration;
use Jadob\EventStore\Exception\AggregateMetadataNotFoundException;
use Jadob\EventStore\Exception\EventStoreException;
use Jadob\MessageBus\ServiceBus;
use JsonException;
use Override;
use Psr\Log\LoggerInterface;
use function count;

/**
 * Access Patterns:
 *
 * - Get aggregate metadata:
 * PK: AGGREGATE#{aggregateId}
 * SK: METADATA
 * - Get aggregate events:
 * PK: AGGREGATE#{aggregateId}
 * SK: begins_with(EVENT#)
 * - Get aggregate event by ID:
 * PK: AGGREGATE#{aggregateId}
 * SK: EVENT#{eventId}
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license proprietary
 */
class DynamoDbEventStore implements EventStoreInterface
{
    private const int MAX_TRANSACTION_ITEMS = 25;
    private readonly ExtensionManager $extensionManager;
    private readonly ServiceBus $commandBus;
    private readonly Marshaler $marshaler;

    protected PayloadSerializer $payloadSerializer;

    /**
     * DynamoDbEventStore constructor.
     *
     * @param EventStoreExtensionInterface[] $extensions
     */
    public function __construct(
        private readonly DynamoDbClient $dynamoDbClient,
        private readonly EventStoreTableConfiguration $table,
        private readonly LoggerInterface $logger,
        ServiceBus $commandBus,
        array $extensions = []
    ) {
        $this->commandBus = $commandBus;
        $this->extensionManager = new ExtensionManager($extensions);
        $this->marshaler = new Marshaler();
        $this->payloadSerializer = new PayloadSerializer();
    }

    /**
     * {@inheritDoc}
     *
     * @throws EventStoreException|JsonException
     */
    #[Override]
    public function saveAggregate(AggregateRootInterface $aggregateRoot)
    {
        $aggregateId = $aggregateRoot->getAggregateId();
        $events = $aggregateRoot->popUncomittedEvents();
        $aggregateType = $aggregateRoot::class;

        /*
         * While dealing with DDB transactions, you should be aware of few limits.
         * One of them is 25 items per WRITE transaction:
         * @see https://docs.aws.amazon.com/amazondynamodb/latest/developerguide/transaction-apis.html
         * @see https://www.alexdebrie.com/posts/dynamodb-transactions/
         */
        if (count($events) > self::MAX_TRANSACTION_ITEMS) {
            throw new EventStoreException('Unable to save aggregate: DynamoDB cannot handle more than 25 items in single transaction.');
        }

        try {
            $metadata = $this->getAggregateMetadata($aggregateId);
            $this->logger->info(sprintf('Found Metadata for aggregate %s.', $aggregateId));
            //@TODO any event after aggregate found?
        } catch (AggregateMetadataNotFoundException) {
            $metadata = new AggregateMetadata($aggregateId, $aggregateType, $aggregateRoot->getCreatedAt());
            $this->logger->info(sprintf('Metadata for aggregate %s was not found, creating them.', $aggregateId));
            $this->extensionManager->dispatchOnAggregateCreate($aggregateRoot, $metadata);
            $this->saveAggregateMetadata($metadata);
        }

        $this->logger->info(sprintf('Begin storing events for aggregate %s.', $aggregateId));

        $items = [];
        /*
         * @see https://docs.aws.amazon.com/amazondynamodb/latest/APIReference/API_TransactWriteItems.html#DDB-TransactWriteItems-request-TransactItems
         * @see https://aws.amazon.com/blogs/aws/new-amazon-dynamodb-transactions/
         */
        foreach ($events as $event) {
            $eventType = $event::class;
            $eventVersion = $event->getAggregateVersion();
            $payload = $this->payloadSerializer->serialize($event->toArray());

            $this->extensionManager->dispatchOnEventAppend($event, $payload, $aggregateRoot);

            /**
             * eid - event id
             * aid - aggregate id
             * ety - event type
             * agv - aggregate version
             * pld - payload
             * tme - timestamp.
             */
            $item = [
                $this->table->getPartitionKeyName() => sprintf('AGGREGATE#%s', $aggregateId),
                $this->table->getSortKeyName() => sprintf('EVENT#%s', $event->getEventId()),
                'eid' => $event->getEventId(),
                AttributeName::AGGREGATE_ID => $aggregateId,
                'ety' => $eventType,
                'agv' => $eventVersion,
                'pld' => $payload,
                /*
                 * May be useful e.g in GSIs
                 */
                AttributeName::OBJECT_TYPE => 'EVENT',
                /*
                 * To avoid collisions in future, each event has it's own timestamp in milliseconds
                 */
                AttributeName::CREATED_AT => $this->dateTimeToTimestamp($event->recordedAt()),
                'atr' => $event->getAttributes(),
            ];

            $writeItem = [
                'Put' => [
                    'TableName' => $this->table->getTableName(),
                    'Item' => $this->marshaler->marshalItem($item),
                ],
            ];

            $items[] = $writeItem;
        }

        $this->dynamoDbClient->transactWriteItems([
            'TransactItems' => $items,
        ]);

        $this->logger->info(sprintf('Done storing events for aggregate %s. Begin to emitting events.', $aggregateId));

        foreach ($events as $event) {
            $this->logger->debug(sprintf('Emitting event %s.', $event::class));
            $this->commandBus->dispatch($event);
        }

        $this->logger->info(sprintf('Done emitting events for aggregate %s.', $aggregateId));
    }

    /**
     * {@inheritDoc}
     */
    #[Override]
    public function getEventsByAggregateId(string $aggregateId): array
    {
        $params = [
            'TableName' => $this->table->getTableName(),
            'KeyConditionExpression' => '#pk = :pk AND begins_with(#sk, :sk)',
            'ExpressionAttributeNames' => [
                '#pk' => $this->table->getPartitionKeyName(),
                '#sk' => $this->table->getSortKeyName(),
            ],
            'ExpressionAttributeValues' => [
                ':pk' => $this->marshaler->marshalValue(sprintf('AGGREGATE#%s', $aggregateId)),
                ':sk' => $this->marshaler->marshalValue('EVENT#'),
            ],
        ];

        $output = [];
        $result = $this->dynamoDbClient->query($params)['Items'];
        foreach ($result as $item) {
            $output[] = $this->marshaler->unmarshalItem($item);
        }

        return $output;
    }

    /**
     * @throws AggregateMetadataNotFoundException
     */
    #[Override]
    public function getAggregateMetadata(string $aggregateId): AggregateMetadata
    {
        //@TODO może to do jakiejś osobnej klasy wydzielić?
        $pk = sprintf('AGGREGATE#%s', $aggregateId);
        $sk = 'METADATA';

        $key = [
            $this->table->getPartitionKeyName() => $pk,
            $this->table->getSortKeyName() => $sk,
        ];

        $params = [
            'TableName' => $this->table->getTableName(),
            'Key' => $this->marshaler->marshalItem($key),
        ];

        $result = $this->dynamoDbClient->getItem($params);
        $resultArray = $result->toArray();
        if (!isset($resultArray['Item'])) {
            throw AggregateMetadataNotFoundException::for($aggregateId);
        }

        $item = $this->marshaler->unmarshalItem($resultArray['Item']);
        /**
         * In this place, createdAt is unix timestamp in MILLISECONDS.
         * We need to turn them to timestamp in SECONDS, and convert MILLISECONDS to MICROSECONDS.
         */
        $dateTime = DateTimeFactory::createFromMilliseconds($item[AttributeName::CREATED_AT]);

        return new AggregateMetadata(
            $item[AttributeName::AGGREGATE_ID],
            $item[AttributeName::AGGREGATE_TYPE],
            $dateTime
        );
    }

    #[Override]
    public function saveAggregateMetadata(AggregateMetadata $metadata): void
    {
        //@TODO może to do jakiejś osobnej klasy wydzielić?
        $pk = sprintf('AGGREGATE#%s', $metadata->getAggregateId());
        $sk = 'METADATA';

        $item = [
            $this->table->getPartitionKeyName() => $pk,
            $this->table->getSortKeyName() => $sk,
            AttributeName::AGGREGATE_ID => $metadata->getAggregateId(),
            AttributeName::AGGREGATE_TYPE => $metadata->getAggregateType(),
            AttributeName::CREATED_AT => $this->dateTimeToTimestamp($metadata->getCreatedAt()),
            AttributeName::OBJECT_TYPE => 'METADATA',
        ];

        $params = [
            'TableName' => $this->table->getTableName(),
            'Item' => $this->marshaler->marshalItem($item),
        ];

        $this->dynamoDbClient->putItem($params);
    }

    /**
     * Watch out: timestamp is in MILLISECONDS.
     */
    protected function dateTimeToTimestamp(DateTimeInterface $dateTime): int
    {
        return (int) ($dateTime->getTimestamp().$dateTime->format('v'));
    }
}

<?php
declare(strict_types=1);

namespace Jadob\Webhook\Event\Aws;

/**
 * Event emitted by DynamoDB Stream
 * This is a rewritten version of DynamoDBStreamEvent from @types/aws-lambda NPM repository
 * @see https://github.com/DefinitelyTyped/DefinitelyTyped/blob/master/types/aws-lambda/trigger/s3.d.ts
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class DynamoDBStreamEvent
{
    protected array $records;

    public function __construct(array $records)
    {
        $this->records = $records;
    }

    /**
     * @return array
     */
    public function getRecords(): array
    {
        return $this->records;
    }
}
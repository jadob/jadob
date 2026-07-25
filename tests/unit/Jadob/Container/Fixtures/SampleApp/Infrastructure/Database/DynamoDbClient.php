<?php

namespace Jadob\Container\Fixtures\SampleApp\Infrastructure\Database;

class DynamoDbClient
{
    public function __construct(
        private string $dynamoDbHost,
        private string $awsClientId,
        private string $awsClientSecret,
        private string $tableName,
    )
    {
    }
}
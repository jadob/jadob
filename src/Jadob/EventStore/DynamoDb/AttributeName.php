<?php
declare(strict_types=1);

namespace Jadob\EventStore\DynamoDb;

class AttributeName
{
    public const AGGREGATE_ID = 'aid';
    public const AGGREGATE_TYPE = 'aty';
    public const CREATED_AT = 'tme';
    public const OBJECT_TYPE = 'oty';
}
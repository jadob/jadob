<?php

namespace Jadob\Container\Fixtures\InvalidServiceHints;

use Jadob\Container\Fixtures\SampleApp\Infrastructure\Database\DatabaseClient;
use Jadob\Container\Fixtures\SampleApp\Infrastructure\Database\DynamoDbClient;
use Jadob\Contracts\DependencyInjection\Attribute\InjectService;

class TwoInjectServiceHintsInOneProperty
{

    public function __construct(
        #[InjectService(DatabaseClient::class)]
        #[InjectService(DynamoDbClient::class)]
        private $val
    )
    {
    }
}
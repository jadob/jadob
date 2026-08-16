<?php

namespace Jadob\Container\Fixtures\SampleApp\Infrastructure\Persistence;

use Jadob\Container\Fixtures\SampleApp\Domain\Repository\UserRepositoryInterface;
use Jadob\Container\Fixtures\SampleApp\Infrastructure\Database\DynamoDbClient;
use Jadob\Contracts\DependencyInjection\Attribute\InjectService;

final class DynamoDbUserRepository implements UserRepositoryInterface
{
    public function __construct(
        #[InjectService(DynamoDbClient::class)] private DynamoDbClient $client
    )
    {
    }
}
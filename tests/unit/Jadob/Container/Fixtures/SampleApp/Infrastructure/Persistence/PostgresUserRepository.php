<?php

namespace Jadob\Container\Fixtures\SampleApp\Infrastructure\Persistence;

use Jadob\Container\Fixtures\SampleApp\Domain\Repository\UserRepositoryInterface;
use Jadob\Container\Fixtures\SampleApp\Infrastructure\Database\DatabaseClient;

class PostgresUserRepository implements UserRepositoryInterface
{
    public function __construct(
        private DatabaseClient $client
    )
    {
    }
}
<?php

declare(strict_types=1);

namespace Jadob\Container\Fixtures\SampleApp\Application\Service;

use Jadob\Container\Fixtures\SampleApp\Domain\Repository\UserRepositoryInterface;
use Jadob\Container\Fixtures\SampleApp\Infrastructure\Persistence\PostgresUserRepository;
use Jadob\Contracts\DependencyInjection\Attribute\InjectService;

class UserService
{
    public function __construct(
        #[InjectService(PostgresUserRepository::class)]
        private UserRepositoryInterface $repository
    )
    {
    }
}
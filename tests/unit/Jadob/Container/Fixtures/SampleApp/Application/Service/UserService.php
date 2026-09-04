<?php

namespace Jadob\Container\Fixtures\SampleApp\Application\Service;

use Jadob\Container\Fixtures\SampleApp\Domain\Repository\UserRepositoryInterface;

class UserService
{
    public function __construct(
        private UserRepositoryInterface $repository
    )
    {
    }
}
<?php

namespace Jadob\Container\Fixtures\UserDomain;

class UserService
{
    public function __construct(
        /** @phpstan-ignore property.onlyWritten */
        private readonly UserRepositoryInterface $userRepository,
    )
    {
    }
}
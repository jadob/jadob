<?php

declare(strict_types=1);

namespace Jadob\Security\Auth\Identity;

use Jadob\Security\Auth\Exception\UserNotFoundException;
use Jadob\Security\Auth\User\UserInterface;

/**
 * @deprecated
 */
interface IdentityProviderInterface
{
    /**
     * @param array<string, mixed> $credentials
     * @throws UserNotFoundException
     * @return mixed
     */
    public function getByCredentials(array $credentials): UserInterface;
}
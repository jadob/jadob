<?php

namespace Jadob\Security\Auth\Identity;

use Jadob\Security\Auth\User\UserInterface;

/**
 * @internal
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class StatelessIdentityStorage implements IdentityStorageInterface
{
    private array $identities = [];

    public function getUser(string $authenticatorName): ?UserInterface
    {
        return $this->identities[$authenticatorName] ?? null;
    }

    public function setUser(UserInterface $user, string $authenticatorName): void
    {
        $this->identities[$authenticatorName] = $user;
    }
}
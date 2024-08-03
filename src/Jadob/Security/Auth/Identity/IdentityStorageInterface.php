<?php

namespace Jadob\Security\Auth\Identity;

use Jadob\Security\Auth\User\UserInterface;

/**
 * @internal
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
interface IdentityStorageInterface
{
    public function getUser(
        string $authenticatorName
    ): ?UserInterface;

    public function setUser(
        UserInterface $user,
        string $authenticatorName
    ): void;

}
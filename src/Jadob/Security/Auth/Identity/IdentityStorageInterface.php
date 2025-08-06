<?php
declare(strict_types=1);

namespace Jadob\Security\Auth\Identity;

use Jadob\Security\Auth\User\UserInterface;

/**
 * @deprecated
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
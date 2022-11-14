<?php

declare(strict_types=1);

namespace Jadob\Security\Auth;

use Jadob\Security\Auth\User\UserInterface;

/**
 * @deprecated
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
interface UserProviderInterface
{
    public function getUserByUsername(string $name): ?UserInterface;

    public function getUserById(string $id): ?UserInterface;
}
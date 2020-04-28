<?php

namespace Jadob\Security\Auth;

use Jadob\Security\Auth\User\UserInterface;

/**
 * Interface UserProviderInterface
 *
 * @package Jadob\Security\Auth
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 */
interface UserProviderInterface
{

    /**
     * @param  $name
     * @return null|UserInterface
     */
    public function getUserByUsername(string $name): ?UserInterface;

    /**
     * @param  $id
     * @return null|UserInterface
     */
    public function getUserById($id): ?UserInterface;
}
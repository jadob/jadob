<?php

namespace Jadob\Security\Auth\UserProvider;

use Jadob\Security\Auth\User\UserInterface;

/**
 * Interface UserProviderInterface
 * @package Jadob\Security\Auth\UserProvider
 * @author pizzaminded <miki@appvende.net>
 */
interface UserProviderInterface
{

    /**
     * @param $credentials
     * @return null|UserInterface
     */
    public function findUserBy($credentials);

    /**
     * @param mixed $id
     * @return UserInterface
     */
    public function getUserById($id): UserInterface;
}
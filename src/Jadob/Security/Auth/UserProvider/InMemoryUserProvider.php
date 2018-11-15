<?php

namespace Jadob\Security\Auth\UserProvider;

use Jadob\Security\Auth\User\UserInterface;

/**
 * @TODO: add description, tests, implement
 * @package Jadob\Security\Auth\UserProvider
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class InMemoryUserProvider implements UserProviderInterface
{

    /**
     * @var array
     */
    protected $users;

    /**
     * InMemoryUserProvider constructor.
     * @param array $users
     */
    public function __construct($users)
    {
        $this->users = $users;
    }

    public function findUserBy($credentials)
    {
        // TODO: Implement findUserBy() method.
    }

    /**
     * @param mixed $id
     * @return UserInterface
     */
    public function getUserById($id): UserInterface
    {
        // TODO: Implement getUserById() method.
    }
}
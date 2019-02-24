<?php

namespace Jadob\Security\Auth\User;

use Jadob\Security\Auth\User\UserInterface;

/**
 * Example User object, that can be used in your app.
 * @package Jadob\Security\Auth\User
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class User implements UserInterface
{

    /**
     * @var string[]
     */
    protected $roles;

    /**
     * @var string
     */
    protected $username;

    /**
     * @var string
     */
    protected $password;

    /**
     * User constructor.
     * @param string $username
     * @param string $password
     * @param array $roles
     */
    public function __construct($username, $password, $roles = [])
    {
        $this->username = $username;
        $this->password = $password;
        $this->roles = $roles;
    }

    /**
     * @return string[]
     */
    public function getRoles(): array
    {
        return $this->roles;
    }

    /**
     * @param string[] $roles
     * @return User
     */
    public function setRoles(array $roles): User
    {
        $this->roles = $roles;
        return $this;
    }

    /**
     * @return string
     */
    public function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return User
     */
    public function setUsername(string $username): User
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }
}
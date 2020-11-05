<?php

namespace Jadob\Security\Auth\User;

/**
 * Example User object, that can be used in your app.
 *
 * @package Jadob\Security\Auth\User
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class User implements UserInterface
{

    /**
     * @var string[]
     */
    protected array $roles;

    /**
     * @var string
     */
    protected string $username;

    /**
     * @var string
     */
    protected string $password;

    /**
     * User constructor.
     *
     * @param string $username
     * @param string $password
     * @param string[] $roles
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
     * @param  string[] $roles
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
     * @param  string $username
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
     * @param  string $password
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }
}

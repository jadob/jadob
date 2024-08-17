<?php
declare(strict_types=1);

namespace Jadob\Security\Auth\User;

/**
 * @deprecated
 * Example User object, that can be used in your app.
 *
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class User implements UserInterface
{

    /**
     * User constructor.
     *
     * @param string $username
     * @param string $password
     * @param string[] $roles
     */
    public function __construct(protected string $username, protected string $password, protected array $roles = [])
    {
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

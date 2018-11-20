<?php

namespace Jadob\Security\Guard;

/**
 * Class GuardDispatcher
 * @package Jadob\Security\Guard
 */
class GuardDispatcher
{
    /**
     * @var GuardAuthenticatorInterface[]
     */
    protected $guards = [];

    /**
     * @param GuardAuthenticatorInterface $authenticator
     * @param string|null $name
     * @return GuardDispatcher
     */
    public function addGuard(GuardAuthenticatorInterface $authenticator, $name = null)
    {
        $this->guards[$name] = $authenticator;
        return $this;
    }
}
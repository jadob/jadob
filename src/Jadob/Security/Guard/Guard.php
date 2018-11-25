<?php

namespace Jadob\Security\Guard;

use Jadob\Security\Auth\UserProviderInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class GuardDispatcher
 * @package Jadob\Security\Guard
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class Guard
{
    /**
     * @var GuardAuthenticatorInterface[]
     */
    protected $guards = [];

    /**
     * @var UserProviderInterface[]
     */
    protected $userProviders = [];

    /**
     * @param GuardAuthenticatorInterface $authenticator
     * @param string|null $name
     * @return Guard
     */
    public function addGuard(GuardAuthenticatorInterface $authenticator, $name)
    {
        $this->guards[$name] = $authenticator;
        return $this;
    }

    public function addUserProvider(UserProviderInterface $userProvider, $name)
    {
        $this->userProviders[$name] = $userProvider;
        return $this;
    }

    public function matchRule(Request $request)
    {
        foreach ($this->guards as $guard) {
            if ($guard->requestMatches($request)) {
                return $guard;
            }
        }

        return null;
    }


    public function execute(Request $request)
    {

    }
}
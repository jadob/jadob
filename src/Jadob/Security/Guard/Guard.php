<?php

namespace Jadob\Security\Guard;

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
     * @param GuardAuthenticatorInterface $authenticator
     * @param string|null $name
     * @return Guard
     */
    public function addGuard(GuardAuthenticatorInterface $authenticator)
    {
        $this->guards[] = $authenticator;
        return $this;
    }


    public function dispatchRequest(Request $request)
    {
        foreach ($this->guards as $guard) {
            if($guard->requestMatches($request)) {

            }
        }
    }
}
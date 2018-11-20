<?php

namespace Jadob\Security\Guard;

use Symfony\Component\HttpFoundation\Request;

/**
 * Interface GuardAuthenticatorInterface
 * @package Jadob\Security\Guard
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
interface GuardAuthenticatorInterface
{

    /**
     * Checks if current request should be protected using this authenticator.
     *
     * DO NOT CHECK IF USER IS LOGGED IN THIS METHOD!11
     * If request will be matched, getUser() will be called anyway.
     * @return bool
     */
    public function requestMatches(Request $request);

    public function extractCredentialsFromRequest(Request $request);

    public function getUser($userData);


}
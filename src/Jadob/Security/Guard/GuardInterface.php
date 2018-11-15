<?php

namespace Jadob\Security\Guard;

use Symfony\Component\HttpFoundation\Request;

/**
 * This interface should be implemented by all your guard classes.
 * @package Jadob\Security\Guard
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
interface GuardInterface
{

    /**
     * This function needs to return anything!
     * If void or null returned, AuthenticationFailureException will be thrown.
     * @param Request $request
     * @return mixed
     */
    public function extractCredentials(Request $request);


    /**
     * Here you can define all requirements that need to be verified.
     * If everything is true, then
     * @param Request $request
     * @return bool
     */
    public function matchRequest(Request $request): bool;

    /**
     * If true, user session will be terminated on end of each request.
     * Otherwise, it will be stored in session.
     * @return bool
     */
    public function isStateless(): bool;

}
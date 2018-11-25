<?php

namespace Jadob\Security\Guard;

use Jadob\Security\Auth\User\UserInterface;
use Jadob\Security\Auth\UserProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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

    public function verifyCredentials($credentials, UserInterface $user);

    public function getUserFromProvider($credentials, UserProviderInterface $userProvider);

    /**
     * This action will be called if current guard matches but there is no user object in UserStorage
     */
    public function createNotLoggedInResponse(): Response;

    /**
     * @return Response
     */
    public function createInvalidCredentialsResponse(): Response;

    /**
     * @return null|Response
     */
    public function createSuccessAuthenticationResponse();



}
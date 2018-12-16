<?php

namespace Jadob\Security\Guard;

use Jadob\Security\Auth\User\UserInterface;
use Jadob\Security\Auth\UserProviderInterface;
use Jadob\Security\Exception\InvalidCredentialsException;
use Jadob\Security\Exception\UserNotFoundException;
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
     * If request will be matched, getUserFromProvider() will be called anyway.
     * @return bool
     */
    public function requestMatches(Request $request);

    public function extractCredentialsFromRequest(Request $request);

    public function verifyCredentials($credentials, UserInterface $user);

    public function getUserFromProvider($credentials, UserProviderInterface $userProvider);

    /**
     * When getUserFromProvider() will throw an UserNotFound or return null|not an UserInterface instance, it will be passed
     * as an argument.
     * This action will be called if current guard matches but there is no user object in UserStorage
     * @param UserNotFoundException|null $exception
     * @return Response
     */
    public function createNotLoggedInResponse(?UserNotFoundException $exception = null): Response;

    /**
     * When extractCredentialsFromRequest() or verifyCredentials() throw InvalidCredentialsException, this method will
     * be called.
     *
     * @param InvalidCredentialsException|null $exception
     * @return Response
     */
    public function createInvalidCredentialsResponse(?InvalidCredentialsException $exception = null): Response;

    /**
     * @return null|Response
     */
    public function createSuccessAuthenticationResponse();


}
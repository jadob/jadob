<?php

namespace Jadob\Security\Supervisor\RequestSupervisor;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
interface RequestSupervisorInterface
{
    /**
     * Decides that authentication process should start or not.
     *
     * Allows to create actions that can be accessed both by unauthenticated and authenticated users.
     * If return value is false, Supervisor will check if client is authenticated and run authentication process if not.
     * Otherwise, request will continue, but user object will be available only for logged user.
     *
     * @param Request $request
     * @return bool
     */
    public function isAnonymousRequestAllowed(Request $request): bool;

    /**
     * Checks if request contains credentials.
     * Method is not called when stateless.
     *
     * @param Request $request
     * @return bool
     */
    public function isAuthenticationRequest(Request $request): bool;

    /**
     * Extracts client credentials from request object.
     * Called on each request when stateless. Otherwise, called only when isAuthenticationRequest() returns true.
     *
     * @param Request $request
     * @return string|array|false
     */
    public function extractCredentialsFromRequest(Request $request);

    /**
     * Called when Authentication process will finish successfully.
     * Using this method you can intercept the request and eg. redirect user to another page. If null returned,
     * Supervisor will continue the request.
     *
     * Return value is ignored when stateless.
     * @return Response|null
     */
    public function handleAuthenticationSuccess(): ?Response;

    /**
     * Called when Authentication process will break for some reasons.
     * Whether stateless or not, return value will be sent to user.
     *
     * @return Response|null
     */
    public function handleAuthenticationFailure(): Response;

    /**
     * If true, stored identity will be removed on request termination.
     * Otherwise, identity will be kept until session ends.
     * @return bool
     */
    public function isStateless(): bool;

    /**
     * This is a place, where you can throw UserNotFoundException.
     *
     * @return mixed
     */
    public function getClientFromProvider();

    public function verifyClientCredentials(): bool;

    /**
     * Called as first method.
     * Please keep in mind that supervisor will return FIRST requestsupervisor that returns true in this method.
     * Be strict with your request handling.
     * @param Request $request
     * @return bool
     */
    public function supports(Request $request): bool;
}
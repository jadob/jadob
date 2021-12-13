<?php

namespace Jadob\Security\Supervisor\RequestSupervisor;

use Jadob\Security\Auth\Exception\AuthenticationException;
use Jadob\Security\Auth\User\UserInterface;
use Jadob\Security\Auth\UserProviderInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
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
     * @param  Request $request
     * @return bool
     */
    public function isAnonymousRequestAllowed(Request $request): bool;

    /**
     * Checks if request contains credentials.
     * Method is not called when stateless.
     * @TODO: refactor - method is useless for stateless things so it should not be present in interface
     * @param  Request $request
     * @return bool
     */
    public function isAuthenticationRequest(Request $request): bool;

    /**
     * Extracts client credentials from request object.
     * Called on each request when stateless. Otherwise, called only when isAuthenticationRequest() returns true.
     * If false or null returned, a UserNotFoundException will be thrown.
     *
     * @param  Request $request
     * @return string|array|false
     */
    public function extractCredentialsFromRequest(Request $request);

    /**
     * Called when Authentication process will finish successfully.
     * Using this method you can intercept the request and eg. redirect user to another page. If null returned,
     * Supervisor will continue the request.
     * When stateless, method is called but returned Response is ignored.
     *
     * @param  Request       $request
     * @param  UserInterface $user
     * @return Response|null
     */
    public function handleAuthenticationSuccess(Request $request, UserInterface $user): ?Response;

    /**
     * Called when Authentication process will break for some reasons.
     * Whether stateless or not, return value, if not null, will be sent to user.
     * Otherwise, when there is null returned, supervisor will continue with request handling.
     *
     * @param AuthenticationException $exception
     * @param Request $request
     * @return Response|null
     */
    public function handleAuthenticationFailure(AuthenticationException $exception, Request $request): ?Response;

    /**
     * If true, stored identity will be removed on request termination.
     * Otherwise, identity will be kept until session ends.
     *
     * @return bool
     */
    public function isStateless(): bool;

    /**
     * This is a place, where you can throw UserNotFoundException.
     *
     * @param $credentials
     * @param UserProviderInterface $userProvider
     *
     * @return UserInterface|null
     */
    public function getIdentityFromProvider($credentials, UserProviderInterface $userProvider): ?UserInterface;

    //@TODO add documentation
    public function verifyIdentity(UserInterface $user, $credentials): bool;

    /**
     * Called as first method.
     * Please keep in mind that supervisor will return FIRST requestsupervisor that returns true in this method.
     * Be strict with your request handling.
     *
     * @param  Request $request
     * @return bool
     */
    public function supports(Request $request): bool;

    /**
     * Called when authentication is required and user is not logged in.
     * @return Response
     */
    public function handleUnauthenticated(): Response;
}
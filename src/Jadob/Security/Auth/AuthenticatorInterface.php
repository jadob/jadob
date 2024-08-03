<?php

namespace Jadob\Security\Auth;

use Jadob\Security\Auth\Exception\AuthenticationException;
use Jadob\Security\Auth\User\UserInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface AuthenticatorInterface
{
    public function supports(Request $request): bool;

    public function isAnonymousAccessAllowed(Request $request): bool;

    /**
     * For stateless requests this method should check if credentials are passed along with the content.
     * @param Request $request
     * @return bool
     */
    public function isAuthenticationRequest(Request $request): bool;

    public function authenticate(Request $request): ?UserInterface;
    
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response;

    public function onAuthenticationSuccess(Request $request, UserInterface $user): ?Response;

    public function isStateless(): bool;
}
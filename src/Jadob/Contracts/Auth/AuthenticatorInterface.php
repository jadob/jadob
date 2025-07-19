<?php

namespace Jadob\Contracts\Auth;

use Jadob\Contracts\Auth\Exception\AuthenticationException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface AuthenticatorInterface
{
    public function supports(Request $request): bool;

    public function onAuthenticationFailure(
        AuthenticationException $exception,
    ): ?Response;

    /**
     * Triggered on successful authentication.
     * @param IdentityInterface $identity
     * @return Response|null
     */
    public function onAuthenticationSuccess(
        IdentityInterface $identity,
    ): ?Response;
}
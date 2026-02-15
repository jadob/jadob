<?php

namespace Jadob\Authora\Fixtures;

use Jadob\Contracts\Auth\Identity;
use Jadob\Contracts\Auth\Exception\AuthenticationException;
use Jadob\Contracts\Auth\IdentityInterface;
use Jadob\Contracts\Auth\StatelessAuthenticatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DummyStatelessAuthenticator implements StatelessAuthenticatorInterface
{
    public function __construct(
        private string $supportedPath,
    )
    {
    }

    public function supports(Request $request): bool
    {
        return $this->supportedPath === $request->getPathInfo();
    }

    public function onAuthenticationFailure(AuthenticationException $exception): ?Response
    {
        // TODO: Implement onAuthenticationFailure() method.
    }

    public function onAuthenticationSuccess(IdentityInterface $identity): ?Response
    {
        return null;
    }

    public function authenticate(Request $request): Identity
    {
        return new Identity(
            'mruczek',
            []
        );
    }
}
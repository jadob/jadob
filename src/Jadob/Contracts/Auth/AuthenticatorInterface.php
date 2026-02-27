<?php
declare(strict_types=1);

namespace Jadob\Contracts\Auth;

use Jadob\Contracts\Auth\Exception\AuthenticationException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @deprecated
 */
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

    /**
     * @throws AuthenticationException
     */
    public function authenticate(
        Request $request,
    ): AccessToken;
}
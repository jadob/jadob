<?php
declare(strict_types=1);

namespace Jadob\Auth\Authenticator;

use Jadob\Auth\AccessToken\AccessToken;
use Jadob\Auth\AuthenticatorInterface;
use Jadob\Auth\Identity\IdentityInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Checks if user information is stored in session.
 * @license MIT
 */
class SessionAuthenticator implements AuthenticatorInterface
{
    public function supports(Request $request): bool
    {
        // TODO: Implement supports() method.
    }

    public function authenticate(Request $request): AccessToken
    {
        // TODO: Implement authenticate() method.
    }

    public function onAuthenticationSuccess(Request $request, IdentityInterface $identity): ?Response
    {
        // TODO: Implement onAuthenticationSuccess() method.
    }

    public function onAuthenticationFailure(Request $request, IdentityInterface $identity): ?Response
    {
        // TODO: Implement onAuthenticationFailure() method.
    }
}
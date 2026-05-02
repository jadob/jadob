<?php
declare(strict_types=1);

namespace Jadob\Auth;

use Jadob\Auth\AccessToken\AccessToken;
use Jadob\Auth\Identity\IdentityInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface AuthenticatorInterface
{
    /**
     * Determines if given request can be processed by this authenticator.
     * For stateful ones, you check whether this is a login attempt (or if there is a logged user in session already).
     * For stateless you can either check for credentials in request, or just return true
     * @param Request $request
     * @return bool
     */
    public function supports(Request $request): bool;

    public function authenticate(Request $request): AccessToken;

    public function onAuthenticationSuccess(Request $request, IdentityInterface $identity): ?Response;

    public function onAuthenticationFailure(Request $request, IdentityInterface $identity): ?Response;
}
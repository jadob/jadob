<?php

namespace Jadob\Security\Auth;

use Symfony\Component\HttpFoundation\Request;

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

    public function authenticate(Request $request, IdentityStorage $identityStorage);

    public function onAuthenticationFailure();

    public function onAuthenticationSuccess();
}
<?php

namespace Jadob\Contracts\Auth;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface StatefulAuthenticatorInterface extends AuthenticatorInterface
{
    /**
     * @param Request $request
     * @return bool
     */
    public function isAuthenticationRequest(
        Request $request,
    ): bool;

    public function isAnonymousAccessAllowed(
        Request $request,
    ): bool;

    /**
     * When true, each authentication request will store another identity.
     * When false, currently stored identity will be removed (if exists), and new one will be stored.
     * @return bool
     */
    public function allowsMultipleIdentities(): bool;

    /**
     * Invoked when unauthenticated user tries to access authenticated resource.
     * @param Request $request
     * @return Response
     */
    public function onUnauthenticatedRequest(Request $request): Response;
}
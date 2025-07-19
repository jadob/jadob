<?php

namespace Jadob\Contracts\Auth;

use Jadob\Contracts\Auth\Exception\AuthenticationException;
use Symfony\Component\HttpFoundation\Request;

interface StatelessAuthenticatorInterface extends AuthenticatorInterface
{
    /**
     * @throws AuthenticationException
     */
    public function authenticate(
        Request $request,
    ): AccessToken;
}
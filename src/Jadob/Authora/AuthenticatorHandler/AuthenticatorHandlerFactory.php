<?php

namespace Jadob\Authora\AuthenticatorHandler;

use Jadob\Contracts\Auth\AuthenticatorInterface;
use Jadob\Contracts\Auth\StatefulAuthenticatorInterface;
use Jadob\Contracts\Auth\StatelessAuthenticatorInterface;
use LogicException;

class AuthenticatorHandlerFactory
{

    public function createForAuthenticator(
        AuthenticatorInterface $authenticator,
    ): AuthenticatorHandlerInterface
    {
        if ($authenticator instanceof StatefulAuthenticatorInterface) {
            return new StatefulAuthenticatorHandler();
        }

        if ($authenticator instanceof StatelessAuthenticatorInterface) {
            return new StatelessAuthenticatorHandler();
        }

        throw new LogicException(
            sprintf(
                'Class "%s" must either implement "%s" or "%s" to handle authentication.',
                get_class($authenticator),
                StatelessAuthenticatorInterface::class,
                StatefulAuthenticatorInterface::class
            )
        );
    }

}
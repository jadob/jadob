<?php
declare(strict_types=1);

namespace Jadob\Authora\AuthenticatorHandler;

use Jadob\Contracts\Auth\IdentityPoolInterface;
use Jadob\Contracts\Auth\AuthenticatorInterface;
use Jadob\Contracts\Auth\IdentityProviderInterface;
use Jadob\Core\Event\RequestEvent;

interface AuthenticatorHandlerInterface
{
    public function __invoke(
        AuthenticatorInterface    $authenticator,
        IdentityPoolInterface     $identityPool,
        RequestEvent              $requestEvent,
        IdentityProviderInterface $identityProvider,
        string                    $authenticatorName,
    ): void;
}
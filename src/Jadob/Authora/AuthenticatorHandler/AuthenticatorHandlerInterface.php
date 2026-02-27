<?php
declare(strict_types=1);

namespace Jadob\Authora\AuthenticatorHandler;

use Jadob\Contracts\Auth\AccessTokenStorageInterface;
use Jadob\Contracts\Auth\AuthenticatorInterface;
use Jadob\Contracts\Auth\IdentityProviderInterface;
use Jadob\Core\Event\RequestEvent;

/**
 * @deprecated
 */
interface AuthenticatorHandlerInterface
{
    public function __invoke(
        AuthenticatorInterface      $authenticator,
        AccessTokenStorageInterface $accessTokenStorage,
        RequestEvent                $requestEvent,
        IdentityProviderInterface   $identityProvider,
        string $authenticatorName,
    ): void;
}
<?php

namespace Jadob\Authora\AuthenticatorHandler;

use Jadob\Contracts\Auth\AccessTokenStorageInterface;
use Jadob\Contracts\Auth\AuthenticatorInterface;
use Jadob\Contracts\Auth\IdentityProviderInterface;
use Jadob\Core\Event\RequestEvent;

class StatefulAuthenticatorHandler implements AuthenticatorHandlerInterface
{
   public function __invoke(
       AuthenticatorInterface $authenticator,
       AccessTokenStorageInterface $accessTokenStorage,
       RequestEvent $requestEvent,
       IdentityProviderInterface $identityProvider
   ): void
   {

   }
}
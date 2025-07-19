<?php

declare(strict_types=1);

namespace Jadob\Authora\AuthenticatorHandler;

use Jadob\Contracts\Auth\AccessTokenStorageInterface;
use Jadob\Contracts\Auth\AuthenticatorInterface;
use Jadob\Contracts\Auth\Exception\AuthenticationException;
use Jadob\Contracts\Auth\IdentityProviderInterface;
use Jadob\Core\Event\RequestEvent;

class StatelessAuthenticatorHandler implements AuthenticatorHandlerInterface
{

    public function __invoke(
        AuthenticatorInterface      $authenticator,
        AccessTokenStorageInterface $accessTokenStorage,
        RequestEvent                $requestEvent,
        IdentityProviderInterface   $identityProvider
    ): void
    {
        try {
            $accessToken = $authenticator->authenticate(
                $requestEvent->requestContext->request,
            );

            $authenticator->onAuthenticationSuccess(
                $identityProvider->getByIdentifier($accessToken->identityId),
            );

            $requestEvent->requestContext->setAccessToken($accessToken);
        } catch (AuthenticationException $exception) {
            $response = $authenticator->onAuthenticationFailure($exception);
            if ($response !== null) {
                $requestEvent->setResponse($response);
            }
        }
    }
}
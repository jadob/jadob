<?php

namespace Jadob\Authora\AuthenticatorHandler;

use Jadob\Contracts\Auth\AccessTokenStorageInterface;
use Jadob\Contracts\Auth\AuthenticatorInterface;
use Jadob\Contracts\Auth\Exception\AuthenticationException;
use Jadob\Contracts\Auth\IdentityProviderInterface;
use Jadob\Contracts\Auth\StatefulAuthenticatorInterface;
use Jadob\Core\Event\RequestEvent;

class StatefulAuthenticatorHandler implements AuthenticatorHandlerInterface
{
    /**
     * @param StatefulAuthenticatorInterface $authenticator
     * @param AccessTokenStorageInterface $accessTokenStorage
     * @param RequestEvent $requestEvent
     * @param IdentityProviderInterface $identityProvider
     * @param string $authenticatorName
     * @return void
     */
    public function __invoke(
        AuthenticatorInterface      $authenticator,
        AccessTokenStorageInterface $accessTokenStorage,
        RequestEvent                $requestEvent,
        IdentityProviderInterface   $identityProvider,
        string                      $authenticatorName,
    ): void
    {
        $request = $requestEvent
            ->requestContext
            ->request;

        $session = $request
            ->getSession();

        $existingIdentity = $accessTokenStorage->getCurrentAccessTokenFromSession(
            $session,
            $authenticatorName
        );

        $isAuthenticationRequest = $authenticator->isAuthenticationRequest($request);
        $isAnonymousAllowed = $authenticator->isAnonymousAccessAllowed($request);


        /**
         * Case #1: authenticated user opens another page in admin panel.
         */
        if (
            $isAuthenticationRequest === false
            && $isAnonymousAllowed === false
            && $existingIdentity !== null
        ) {
            $identity = $identityProvider->getByIdentifier($existingIdentity->identityId);
            $requestEvent->requestContext->setAccessToken($existingIdentity);
            $requestEvent->requestContext->setIdentity($identity);
            return;
        }

        /**
         * Case #2: unauthenticated user tries to open any page on admin panel.
         */
        if (
            $isAuthenticationRequest === false
            && $isAnonymousAllowed === false
            && $existingIdentity === null
        ) {
            $response = $authenticator->onUnauthenticatedRequest($request);
            $requestEvent->setResponse($response);
            return;
        }


        /**
         * Case #3: unauthenticated user tries to access freely available resource
         */
        if (
            $isAnonymousAllowed === true
            && $isAuthenticationRequest === false
            && $existingIdentity === null
        ) {
            return;
        }


        /**
         * Case #4: unauthenticated user tries to log in to admin panel.
         */
        if (
            $isAnonymousAllowed === false
            && $isAuthenticationRequest === true
            && $existingIdentity === null
        ) {

            try {
                $accessToken = $authenticator->authenticate(
                    $requestEvent->requestContext->request,
                );

                $identity = $identityProvider->getByIdentifier($accessToken->identityId);

                $requestEvent->requestContext->setAccessToken($accessToken);
                $requestEvent->requestContext->setIdentity($identity);

                $accessTokenStorage->storeAsCurrent(
                    $accessToken,
                    $authenticatorName,
                    $session
                );

                $response = $authenticator->onAuthenticationSuccess($identity);
                if ($response !== null) {
                    $requestEvent->setResponse($response);
                    return;
                }

            } catch (AuthenticationException $exception) {
                $response = $authenticator->onAuthenticationFailure($exception);
                if ($response !== null) {
                    $requestEvent->setResponse($response);
                }
            }
        }


        throw new AuthenticationException('Undefined or unimplemented behavior.');
    }
}
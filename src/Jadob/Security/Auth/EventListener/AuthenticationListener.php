<?php

namespace Jadob\Security\Auth\EventListener;

use Jadob\Core\Event\RequestEvent;
use Jadob\Security\Auth\AuthenticatorService;
use Jadob\Security\Auth\Event\AuthenticationFailedEvent;
use Jadob\Security\Auth\Exception\AuthenticationException;
use Jadob\Security\Auth\Exception\UnauthenticatedException;
use Jadob\Security\Auth\IdentityStorage;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\EventDispatcher\ListenerProviderInterface;
use Psr\Log\LoggerInterface;

readonly class AuthenticationListener implements ListenerProviderInterface
{
    public function __construct(
        protected AuthenticatorService     $authenticationService,
        protected EventDispatcherInterface $eventDispatcher,
        protected LoggerInterface          $logger
    )
    {
    }

    public function getListenersForEvent(object $event): iterable
    {
        if ($event instanceof RequestEvent) {
            return [
                $this->onRequestEvent(...)
            ];
        }

        return [];
    }

    public function onRequestEvent(RequestEvent $event): void
    {
        $authenticators = $this
            ->authenticationService
            ->getAuthenticators();

        $request = $event->getRequestContext()->getRequest();

        foreach ($authenticators as $authenticatorName => $authenticator) {
            if ($authenticator->supports($request) === false) {
                $this->debugLog(
                    sprintf(
                        'Authenticator "%s" does not supports this request.',
                        $authenticatorName
                    )
                );
                continue;
            }

            $this->debugLog(sprintf(
                'Authenticator "%s" is supporting this request.',
                $authenticatorName
            ));

            # TODO: maybe some factory for this?
            $identityStorage = new IdentityStorage(
                $request->getSession(),
                $authenticatorName
            );

            $storedIdentity = $identityStorage->getUser();
            $event
                ->getRequestContext()
                ->setUser($storedIdentity);

            try {
                $containsCredentials = $authenticator->isAuthenticationRequest($request);
                if ($containsCredentials) {
                    $authenticationResult = $authenticator->authenticate($request);
                    if($authenticationResult === null) {
                        //@TODO: replace it with more detailed exception class.
                        throw new AuthenticationException('User not found.');
                    }

                    $identityStorage->setUser($authenticationResult);
                    $successResponse = $authenticator->onAuthenticationSuccess(
                        $request,
                        $authenticationResult
                    );
                    $event->setResponse($successResponse);
                    return;
                }


                $anonymousAccessAllowed = $authenticator->isAnonymousAccessAllowed($request);
                if ($storedIdentity === null && $anonymousAccessAllowed) {
                    $this->debugLog(sprintf(
                        'Leaving authentication - authenticator "%s" allows for anonymous access, and no identity is present.',
                        $authenticatorName
                    ));
                    return;
                }


                if (
                    $storedIdentity === null
                    && $anonymousAccessAllowed === false
                ) {
                    $this->debugLog(sprintf(
                        'Triggering onAuthenticationFailure - authenticator "%s" does not allows for anonymous access, and no identity is present.',
                        $authenticatorName
                    ));
                    throw new UnauthenticatedException('auth.unauthenticated');
                }
            } catch (AuthenticationException $e) {
                $response = $authenticator->onAuthenticationFailure(
                    $request,
                    $e
                );

                $this
                    ->eventDispatcher
                    ->dispatch(
                        new AuthenticationFailedEvent(
                            $request,
                            $e
                        )
                    );

                $event->setResponse($response);
            }
        }
    }

    protected function debugLog(string $message): void
    {
        $this->logger->debug($message);
    }
}
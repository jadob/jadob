<?php
declare(strict_types=1);

namespace Jadob\Security\Auth\EventListener;

use Jadob\Core\Event\RequestEvent;
use Jadob\EventDispatcher\ListenerProviderPriorityInterface;
use Jadob\Security\Auth\AuthenticatorService;
use Jadob\Security\Auth\Event\AuthenticationFailedEvent;
use Jadob\Security\Auth\Exception\AuthenticationException;
use Jadob\Security\Auth\Exception\UnauthenticatedException;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\EventDispatcher\ListenerProviderInterface;
use Psr\Log\LoggerInterface;

readonly class AuthenticationListener implements ListenerProviderInterface, ListenerProviderPriorityInterface
{
    public function __construct(
        protected AuthenticatorService     $authenticationService,
        protected EventDispatcherInterface $eventDispatcher,
        protected LoggerInterface          $logger
    ) {
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

    public function getListenerPriorityForEvent(object $event): int
    {
        return 110;
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

            $storedIdentity = $this
                ->authenticationService
                ->getStoredIdentity(
                    $request->getSession(),
                    $authenticatorName
                );

            $event
                ->getRequestContext()
                ->setUser($storedIdentity);

            try {
                $containsCredentials = $authenticator->isAuthenticationRequest($request);
                if ($containsCredentials) {
                    $authenticationResult = $authenticator->authenticate($request);
                    if ($authenticationResult === null) {
                        //@TODO: replace it with more detailed exception class.
                        throw new AuthenticationException('User not found.');
                    }

                    $this
                        ->authenticationService
                        ->storeIdentity(
                            $authenticationResult,
                            $request->getSession(),
                            $authenticatorName
                        );

                    $event
                        ->getRequestContext()
                        ->setUser($authenticationResult);

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

            if($storedIdentity === null) {
                return;
            }

            $refreshedUser = $this
                ->authenticationService
                ->refreshIdentity(
                    $storedIdentity,
                    $authenticatorName
                );

            $this
                ->authenticationService
                ->storeIdentity(
                    $refreshedUser,
                    $request->getSession(),
                    $authenticatorName
                );

            $event
                ->getRequestContext()
                ->setUser($refreshedUser);
        }
    }

    protected function debugLog(string $message): void
    {
        $this->logger->debug($message);
    }
}
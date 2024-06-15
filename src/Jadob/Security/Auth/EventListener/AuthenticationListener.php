<?php

namespace Jadob\Security\Auth\EventListener;

use Jadob\Core\Event\RequestEvent;
use Jadob\Security\Auth\AuthenticatorService;
use Jadob\Security\Auth\Exception\AuthenticationException;
use Jadob\Security\Auth\Exception\UnauthenticatedException;
use Jadob\Security\Auth\IdentityStorage;
use Psr\EventDispatcher\ListenerProviderInterface;
use Psr\Log\LoggerInterface;

readonly class AuthenticationListener implements ListenerProviderInterface
{
    public function __construct(
        protected AuthenticatorService $authenticationService,
        protected LoggerInterface $logger
    )
    {
    }

    public function getListenersForEvent(object $event): iterable
    {
        if($event instanceof RequestEvent) {
            return [
                [$this, 'onRequestEvent']
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
            if($authenticator->supports($request) === false) {
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
            try {
                $storedIdentity = $identityStorage->getUser();
                $anonymousAccessAllowed = $authenticator->isAnonymousAccessAllowed($request);
                if ($storedIdentity === null && $anonymousAccessAllowed) {
                    return;
                }

                $containsCredentials = $authenticator->isAuthenticationRequest($request);

                if (
                    $storedIdentity === null
                    && $anonymousAccessAllowed === false
                    && $containsCredentials === false
                ) {
                    throw new UnauthenticatedException('auth.unauthenticated');
                }
            } catch (AuthenticationException $e) {
                $response = $authenticator->onAuthenticationFailure(
                    $request,
                    $e
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
<?php

declare(strict_types=1);

namespace Jadob\Authora\EventListener;

use Jadob\Authora\AuthenticatorHandler\AuthenticatorHandlerFactory;
use Jadob\Authora\AuthenticatorService;
use Jadob\Contracts\Auth\AccessTokenStorageInterface;
use Jadob\Core\Event\RequestEvent;
use Jadob\EventDispatcher\ListenerProviderPriorityInterface;
use Psr\EventDispatcher\ListenerProviderInterface;
use Psr\Log\LoggerInterface;

final readonly class AuthenticationEventListener implements ListenerProviderInterface, ListenerProviderPriorityInterface
{
    public function __construct(
        private AuthenticatorService        $authenticatorService,
        private AccessTokenStorageInterface $accessTokenStorage,
        private AuthenticatorHandlerFactory $authenticatorHandlerFactory,
        private ?LoggerInterface            $authLogger = null,
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

    public function getListenerPriorityForEvent(object $event): int
    {
        return 110;
    }

    public function onRequestEvent(RequestEvent $event): void
    {
        $authenticatorName = $this
            ->authenticatorService
            ->determineEventListenerForRequest(
                $event->requestContext->request
            );

        if ($authenticatorName === null) {
            $this
                ->authLogger
                ?->debug(
                    'None of registered authenticators supports this request.'
                );
        }

        $authenticator = $this
            ->authenticatorService
            ->getAuthenticator($authenticatorName);

        $handler = $this
            ->authenticatorHandlerFactory
            ->createForAuthenticator($authenticator);

        $handler(
            $authenticator,
            $this->accessTokenStorage,
            $event,
            $this->authenticatorService->getIdentityProvider($authenticatorName)
        );
    }
}
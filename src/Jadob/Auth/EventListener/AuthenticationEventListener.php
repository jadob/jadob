<?php
declare(strict_types=1);

namespace Jadob\Auth\EventListener;

use Jadob\Auth\AccessToken\AccessTokenStorage;
use Jadob\Auth\Firewall\FirewallMap;
use Jadob\Core\Event\RequestEvent;
use Jadob\EventDispatcher\ListenerProviderPriorityInterface;
use Psr\EventDispatcher\ListenerProviderInterface;
use Psr\Log\LoggerInterface;

class AuthenticationEventListener implements ListenerProviderInterface, ListenerProviderPriorityInterface
{
    public function __construct(
        private FirewallMap        $firewallMap,
        private ?LoggerInterface   $logger = null,
        private AccessTokenStorage $accessTokenStorage,

    ) {
    }

    public function getListenersForEvent(object $event): iterable
    {
        if ($event instanceof RequestEvent) {
            return [
                $this->handleAuthentication(...)
            ];
        }

        return [];
    }

    public function getListenerPriorityForEvent(object $event): int
    {
        // TODO: Implement getListenerPriorityForEvent() method.
    }

    public function handleAuthentication(RequestEvent $event): void
    {
        $request = $event
            ->requestContext
            ->getRequest();

        $firewall = $this
            ->firewallMap
            ->match($request);

        if ($firewall === null) {
            $this->logger?->debug('No firewall matches this request.');
            return;
        }

        foreach ($firewall->authenticators as $authenticator) {
            if (!$authenticator->supports($request)) {
                continue;
            }

            $token = $authenticator->authenticate($request);
            $this
                ->accessTokenStorage
                ->storeAsCurrent($token);

            if ($firewall->stateless === false) {
                $this
                    ->accessTokenStorage
                    ->saveToSession(
                        $request->getSession()
                    );
            }

            $currentIdentity = $firewall
                ->identityProvider
                ->getByIdentifier(
                    $token->identityId
                );

            $event
                ->requestContext
                ->setIdentity(
                    $currentIdentity
                );

            $authenticator->onAuthenticationSuccess(
                $request,
                $currentIdentity,
            );


        }
    }
}
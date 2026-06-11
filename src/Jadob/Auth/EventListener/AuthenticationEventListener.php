<?php
declare(strict_types=1);

namespace Jadob\Auth\EventListener;

use Jadob\Auth\AccessToken\AccessToken;
use Jadob\Auth\AccessToken\AccessTokenStorageInterface;
use Jadob\Auth\Firewall\Firewall;
use Jadob\Auth\Firewall\FirewallMapInterface;
use Jadob\Contracts\Auth\AuthenticationException;
use Jadob\Core\Event\RequestEvent;
use Jadob\EventDispatcher\ListenerProviderPriorityInterface;
use Psr\EventDispatcher\ListenerProviderInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;

class AuthenticationEventListener implements ListenerProviderInterface, ListenerProviderPriorityInterface
{
    public function __construct(
        private FirewallMapInterface $firewallMap,
        private ?LoggerInterface $logger,
        private AccessTokenStorageInterface $accessTokenStorage,
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
        return 50;
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

        $stateless = $firewall->isStateless();
        $identityStackingEnabled = $firewall->isIdentityStackingEnabled();

        /** @var null|AccessToken $currentToken */
        $currentToken = null;
        if ($stateless === false && $identityStackingEnabled) {
            $currentToken = $this->findStackedToken($firewall, $request);
        }

        if ($stateless === false && $identityStackingEnabled === false) {
            $currentToken = $this
                ->accessTokenStorage
                ->fetchCurrentFromSession($request->getSession());
        }

        if ($currentToken !== null) {
            $currentIdentity = $firewall
                ->getIdentityProvider()
                ->getByIdentifier(
                    $currentToken->identityId
                );

            $event
                ->requestContext
                ->setIdentity(
                    $currentIdentity
                );

            return;
        }



        foreach ($firewall->getAuthenticators() as $authenticator) {
            if (!$authenticator->supports($request)) {
                $this
                    ->logger
                    ?->debug(
                        sprintf(
                            'Authenticator "%s" does not support this request.',
                            get_class($authenticator)
                        )
                    );
                continue;
            }

            try {
                $token = $authenticator->authenticate($request);

                if ($stateless === false) {
                    $this
                        ->accessTokenStorage
                        ->saveToSession(
                            $request->getSession(),
                            $token
                        );
                }

                $currentIdentity = $firewall
                    ->getIdentityProvider()
                    ->getByIdentifier(
                        $token->identityId
                    );

                $event
                    ->requestContext
                    ->setIdentity(
                        $currentIdentity
                    );

                $event
                    ->requestContext
                    ->setAccessToken(
                        $token
                    );

                $authenticator->onAuthenticationSuccess(
                    $request,
                    $currentIdentity,
                );
            } catch (AuthenticationException $exception) {
                $response = $authenticator->onAuthenticationFailure(
                    $request,
                    $exception
                );

                if($response !== null) {
                    $event->setResponse(
                        $response,
                    );

                    return;
                }
            }
        }

        if($firewall->getEntryPoint() !== null) {
            $event->setResponse(
                $firewall
                    ->getEntryPoint()
                    ->commence($request)
            );
        }
    }

    private function findStackedToken(
        Firewall $firewall,
        Request $request,
    ): ?AccessToken {
        $accessTokens = $this
            ->accessTokenStorage
            ->getAllTokens($request->getSession());

        if (count($accessTokens) === 0) {
            return null;
        }

        return $firewall
            ->getIdentityPicker()
            ->pick(
                $request,
                $accessTokens,
            );
    }
}
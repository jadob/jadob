<?php
declare(strict_types=1);

namespace Jadob\Framework\ServiceProvider;

use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Jadob\Security\Auth\AuthenticatorInterface;
use Jadob\Security\Auth\AuthenticatorService;
use Jadob\Security\Auth\EventListener\AuthenticationListener;
use Jadob\Security\Auth\Identity\IdentityProviderInterface;
use Jadob\Security\Auth\Identity\IdentityStorageFactory;
use Jadob\Security\Auth\Identity\RefreshableIdentityProviderInterface;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Log\LoggerInterface;

class AuthenticationProvider implements ServiceProviderInterface
{
    public function getConfigNode(): ?string
    {
        return 'authenticator';
    }

    public function register(ContainerInterface $container, null|object|array $config = null): array
    {
        return [
            IdentityStorageFactory::class =>
                fn(ContainerInterface $container): IdentityStorageFactory => new IdentityStorageFactory(),

            AuthenticatorService::class =>
                static function (ContainerInterface $container) use ($config): AuthenticatorService {
                    /** @var array<string, AuthenticatorInterface> $authenticators */
                    $authenticators = [];
                    /** @var array<string, IdentityProviderInterface> $userProviders */
                    $userProviders = [];
                    /** @var array<string, RefreshableIdentityProviderInterface> $refreshers */
                    $refreshers = [];

                    foreach ($config['authenticators'] as $name => $authenticatorConfig) {
                        $authenticators[$name] = $container->get($authenticatorConfig['service']);
                        $userProviders[$name] = $container->get($authenticatorConfig['user_provider']);

                        if (array_key_exists('refresher', $authenticatorConfig)) {
                            $refreshers[$name] = $container->get($authenticatorConfig['refresher']);
                        }
                    }

                    return new AuthenticatorService(
                        $container->get(IdentityStorageFactory::class),
                        $authenticators,
                        $userProviders,
                        $refreshers
                    );
                },

            AuthenticationListener::class => fn(ContainerInterface $container): AuthenticationListener => new AuthenticationListener(
                $container->get(AuthenticatorService::class),
                $container->get(EventDispatcherInterface::class),
                /**
                 * @TODO: create separate logger for auth
                 */
                $container->get(LoggerInterface::class),
            )
        ];
    }
}
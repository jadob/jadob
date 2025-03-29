<?php
declare(strict_types=1);

namespace Jadob\Framework\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\Exception\ContainerException;
use Jadob\Container\Exception\ServiceNotFoundException;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Jadob\EventDispatcher\EventDispatcher;
use Jadob\Security\Auth\AuthenticatorInterface;
use Jadob\Security\Auth\AuthenticatorService;
use Jadob\Security\Auth\EventListener\AuthenticationListener;
use Jadob\Security\Auth\Identity\IdentityProviderInterface;
use Jadob\Security\Auth\Identity\IdentityStorageFactory;
use Jadob\Security\Auth\Identity\RefreshableIdentityProviderInterface;
use Monolog\Logger;
use Override;
use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Log\LoggerInterface;

class AuthenticationProvider implements ServiceProviderInterface
{
    public function getConfigNode(): string
    {
        return 'authenticator';
    }

    public function register(ContainerInterface $container, ?array $config): array
    {
        return [
            'jadob.auth.auth_logger' =>
                fn(ContainerInterface $container): LoggerInterface => new Logger('authenticator', [
                    $container->get('logger.handler.default')
                ]),
            IdentityStorageFactory::class =>
                fn(ContainerInterface $container): IdentityStorageFactory => new IdentityStorageFactory(),

            AuthenticatorService::class =>
                function (ContainerInterface $container) use ($config): AuthenticatorService {
                    /** @var array<string, AuthenticatorInterface> $authenticators */
                    $authenticators = [];
                    /** @var array<string, IdentityProviderInterface> $userProviders */
                    $userProviders = [];
                    /** @var array<string, RefreshableIdentityProviderInterface> $refreshers */
                    $refreshers = [];

                    foreach ($config['authenticators'] as $name => $authenticatorConfig) {
                        $authenticators[$name] = $container->get($authenticatorConfig['service']);
                        $userProviders[$name] = $container->get($authenticatorConfig['user_provider']);

                        if(array_key_exists('refresher', $authenticatorConfig)) {
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
                $container->get('jadob.auth.auth_logger')
            )
        ];
    }


}
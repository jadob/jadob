<?php

namespace Jadob\Security\Auth\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\Exception\ContainerException;
use Jadob\Container\Exception\ServiceNotFoundException;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\EventDispatcher\EventDispatcher;
use Jadob\Security\Auth\AuthenticatorInterface;
use Jadob\Security\Auth\AuthenticatorService;
use Jadob\Security\Auth\EventListener\AuthenticationListener;
use Jadob\Security\Auth\UserProviderInterface;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Log\LoggerInterface;

class AuthenticationProvider implements ServiceProviderInterface
{

    public function getConfigNode()
    {
        return 'authenticator';
    }

    public function register($config)
    {
        return [
            'jadob.auth.auth_logger' => function (ContainerInterface $container): LoggerInterface {
                return new Logger('authenticator', [
                    $container->get('logger.handler.default')
                ]);
            },
            AuthenticatorService::class =>
                function (ContainerInterface $container) use ($config): AuthenticatorService {
                    /** @var array<string, AuthenticatorInterface> $authenticators */
                    $authenticators = [];
                    /** @var array<string, UserProviderInterface> $userProviders */
                    $userProviders = [];

                    foreach ($config['authenticators'] as $name => $authenticatorConfig) {
                        $authenticators[$name] = $container->get($authenticatorConfig['service']);
                        $userProviders[$name] = $container->get($authenticatorConfig['user_provider']);
                    }

                    return new AuthenticatorService($authenticators, $userProviders);
                },

            AuthenticationListener::class => function (ContainerInterface $container): AuthenticationListener {
                return new AuthenticationListener(
                    $container->get(AuthenticatorService::class),
                    $container->get(EventDispatcherInterface::class),
                    $container->get('jadob.auth.auth_logger')
                );
            }
        ];
    }

    /**
     * @throws ServiceNotFoundException
     * @throws ContainerException
     */
    public function onContainerBuild(Container $container, $config): void
    {
        /** @var EventDispatcher $eventDispatcher */
        $eventDispatcher = $container->get(EventDispatcherInterface::class);
        $eventDispatcher->addListener(
            $container->get(AuthenticationListener::class)
        );
    }
}
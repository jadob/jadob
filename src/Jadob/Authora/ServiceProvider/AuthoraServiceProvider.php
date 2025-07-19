<?php

declare(strict_types=1);

namespace Jadob\Authora\ServiceProvider;

use Jadob\Authora\AccessTokenStorageService;
use Jadob\Authora\AuthenticatorHandler\AuthenticatorHandlerFactory;
use Jadob\Authora\AuthenticatorHandler\AuthenticatorHandlerInterface;
use Jadob\Authora\AuthenticatorService;
use Jadob\Authora\EventListener\AuthenticationEventListener;
use Jadob\Container\ServiceProvider\DefaultConfigProviderInterface;
use Jadob\Contracts\Auth\AccessTokenStorageInterface;
use Jadob\Contracts\DependencyInjection\ConfigObjectProviderInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Psr\Container\ContainerInterface;

class AuthoraServiceProvider implements ServiceProviderInterface, ConfigObjectProviderInterface
{
    public function getConfigNode(): ?string
    {
        return 'authenticator';
    }

    /**
     * @param ContainerInterface $container
     * @param AuthoraConfiguration $config
     * @return array|array[]|\Closure[]|object[]
     */
    public function register(ContainerInterface $container, object|array|null $config = null): array
    {
        return [
            AuthenticatorService::class => function (ContainerInterface $container) use ($config) {
                $authenticationService = new AuthenticatorService();
                foreach ($config->authenticators as $name => $serviceId) {
                    $authenticationService
                        ->registerNewAuthenticator(
                            $name,
                            $container->get($serviceId),
                            $container->get($config->userProviders[$name])
                        );
                }

                return $authenticationService;
            },
            AccessTokenStorageInterface::class => function (ContainerInterface $container) {
                return new AccessTokenStorageService();
            },
            AuthenticatorHandlerFactory::class => function (ContainerInterface $container) {
                return new AuthenticatorHandlerFactory();
            },
            AuthenticationEventListener::class => function (ContainerInterface $container) {
                return new AuthenticationEventListener(
                    $container->get(AuthenticatorService::class),
                    $container->get(AccessTokenStorageInterface::class),
                    $container->get(AuthenticatorHandlerFactory::class)
                );
            }
        ];
    }

    public function getDefaultConfigurationObject(): object
    {
        return new AuthoraConfiguration();
    }
}
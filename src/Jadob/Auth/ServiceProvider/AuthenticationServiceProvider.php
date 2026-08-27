<?php

declare(strict_types=1);

namespace Jadob\Auth\ServiceProvider;

use Jadob\Auth\AccessToken\AccessTokenStorage;
use Jadob\Auth\AccessToken\AccessTokenStorageInterface;
use Jadob\Auth\AuthenticatorInterface;
use Jadob\Auth\EventListener\AuthenticationEventListener;
use Jadob\Auth\Firewall\Firewall;
use Jadob\Auth\Firewall\FirewallMap;
use Jadob\Auth\Firewall\FirewallMapInterface;
use Jadob\Container\Config\ConfigNodeInterface;
use Jadob\Contracts\DependencyInjection\ConfigObjectProviderInterface;
use Jadob\Contracts\DependencyInjection\ContainerBuilderInterface;
use Jadob\Contracts\DependencyInjection\Reference;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Jadob\Framework\Logger\LoggerFactory;
use LogicException;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

final readonly class AuthenticationServiceProvider implements ServiceProviderInterface, ConfigObjectProviderInterface
{
    public function getDefaultConfigurationObject(): ConfigNodeInterface
    {
        return new AuthenticationConfig();
    }

    public function getConfigNode(): string
    {
        return 'authentication';
    }

    public function register(ContainerBuilderInterface $builder, ?ConfigNodeInterface $config = null): void
    {
        $builder
            ->set(AccessTokenStorage::class);

        $builder
            ->bind(AccessTokenStorageInterface::class, AccessTokenStorage::class);

        $builder
            ->set('authentication.logger', LoggerInterface::class)
            ->withFactory(static function (LoggerFactory $loggerFactory): LoggerInterface {
                return $loggerFactory
                    ->getLoggerForChannel('authentication');
            });

        $builder
            ->set(AuthenticationEventListener::class)
            ->autowire()
            ->withArgument('logger', Reference::service('authentication.logger'))
            ->withTag('event_listener');


        $builder
            ->set(FirewallMap::class)
            ->withFactory(static function (ContainerInterface $container) use ($config): FirewallMapInterface {
                $firewalls = [];

                foreach ($config->firewalls as $name => $firewallConfig) {
                    $entryPointServiceId = $firewallConfig->entryPointServiceId;
                    $requestMatcherServiceId = $firewallConfig->requestMatcherServiceId;

                    if ($entryPointServiceId === null) {
                        throw new LogicException(
                            sprintf(
                                'Entry point service id is not defined for firewall "%s".',
                                $name
                            )
                        );
                    }

                    /** @var AuthenticatorInterface[] $authenticators */
                    $authenticators = array_map(
                        static function (string $authenticatorServiceId) use ($container) {
                            return $container->get($authenticatorServiceId);
                        },
                        $firewallConfig->getAuthenticators()
                    );

                    $identityPicker = null;
                    if ($firewallConfig->identityPickerServiceId !== null) {
                        $identityPicker = $container->get($firewallConfig->identityPickerServiceId);
                    }

                    $firewalls[$name] = new Firewall(
                        name: $name,
                        requestMatcher: $container->get($requestMatcherServiceId),
                        authenticators: $authenticators,
                        identityProvider: $container->get($firewallConfig->identityProviderServiceId),
                        entryPoint: $container->get($entryPointServiceId),
                        stateless: $firewallConfig->isStateless(),
                        identityStackingEnabled: $firewallConfig->isIdentityStackingEnabled(),
                        identityPicker: $identityPicker,
                    );
                }
                return new FirewallMap($firewalls);
            });

        $builder
            ->bind(FirewallMapInterface::class, FirewallMap::class);
    }
}
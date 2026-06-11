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
use Jadob\Contracts\DependencyInjection\ConfigObjectProviderInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Jadob\Framework\Logger\LoggerFactory;
use LogicException;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\RequestMatcherInterface;
use Symfony\Component\Security\Core\Event\AuthenticationEvent;

final readonly class AuthenticationServiceProvider implements ServiceProviderInterface, ConfigObjectProviderInterface
{
    public function getDefaultConfigurationObject(): object
    {
        return new AuthenticationConfig();
    }

    public function getConfigNode(): ?string
    {
        return 'authentication';
    }

    /**
     * @param ContainerInterface $container
     * @param AuthenticationConfig $config
     * @return array|array[]|\Closure[]|object[]
     */
    public function register(ContainerInterface $container, object|array|null $config = null): array
    {
        return [
            'authentication.logger' => static function (ContainerInterface $container): LoggerInterface {
                /** @var LoggerFactory $loggerFactory */
                $loggerFactory = $container->get(LoggerFactory::class);

                return $loggerFactory
                    ->getLoggerForChannel('authentication');
            },

            FirewallMapInterface::class => static function (ContainerInterface $container) use ($config): FirewallMapInterface {
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

                    $firewalls[$name] = new Firewall(
                        name: $name,
                        requestMatcher: $container->get($requestMatcherServiceId),
                        authenticators: $authenticators,
                        identityProvider: $container->get($firewallConfig->identityProviderServiceId),
                        entryPoint: $container->get($entryPointServiceId),
                        stateless: $firewallConfig->isStateless(),
                        identityStackingEnabled: $firewallConfig->isIdentityStackingEnabled(),
                        identityPicker: $container->get($firewallConfig->identityPickerServiceId),
                    );
                }
                return new FirewallMap($firewalls);
            },

            AccessTokenStorageInterface::class => function (): AccessTokenStorageInterface {
                return new AccessTokenStorage();
            },

            AuthenticationEventListener::class => static function (ContainerInterface $container): AuthenticationEventListener {
                return new AuthenticationEventListener(
                    firewallMap: $container->get(FirewallMapInterface::class),
                    logger: $container->get('authentication.logger'),
                    accessTokenStorage: $container->get(AccessTokenStorageInterface::class),
                );
            }
        ];
    }
}
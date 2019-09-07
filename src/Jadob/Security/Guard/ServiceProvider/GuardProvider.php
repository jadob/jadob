<?php

namespace Jadob\Security\Guard\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\Security\Guard\EventListener\GuardRequestListener;
use Jadob\Security\Guard\Guard;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;

/**
 * @deprecated
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class GuardProvider implements ServiceProviderInterface
{


    /**
     * {@inheritdoc}
     */
    public function getConfigNode()
    {
        return 'framework';
    }

    /**
     * {@inheritdoc}
     */
    public function register($config): array
    {
        return [
            Guard::class => function (ContainerInterface $container) use ($config) {
                return new Guard(
                    $container->get('auth.user.storage'),
                    $config['security']['excluded_paths'] ?? []
                );
            }
        ];

    }

    /**
     * [@inheritdoc}
     */
    public function onContainerBuild(Container $container, $config)
    {
        $security = $config['security'];
        $guards = $security['guards'];

        $guardService = $container->get(Guard::class);

        foreach ($guards as $guardKey => $guard) {
            $guardService->addGuard($container->get($guard['service']), $guardKey);
            $guardService->addUserProvider($container->get($guard['user_provider']), $guardKey);
        }

        $container->add('guard', $guardService);
        $container->get('event.listener')->addListener(
            new GuardRequestListener(
                $guardService,
                $container->get(LoggerInterface::class)
            )
            , 21);
    }
}
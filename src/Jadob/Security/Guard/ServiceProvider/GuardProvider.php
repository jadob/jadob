<?php

namespace Jadob\Security\Guard\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\ContainerBuilder;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\Security\Guard\EventListener\GuardRequestListener;
use Jadob\Security\Guard\Guard;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class GuardProvider
 * @package Jadob\Security\Guard\ServiceProvider
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
    public function register(ContainerBuilder $container, $config)
    {

    }

    /**
     * [@inheritdoc}
     */
    public function onContainerBuild(Container $container, $config)
    {
        $security = $config['security'];
        $guards = $security['guards'];

        $guardService = new Guard();

        foreach ($guards as $guard) {
            $guardService->addGuard($container->get($guard['service']));
        }

        $container->add('guard', $guardService);
        $container->get('event.listener')->addListener(
            new GuardRequestListener($guardService,
                $container->get('auth.user.storage')
            )
        );
    }
}
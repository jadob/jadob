<?php

namespace Jadob\Security\Auth\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\ContainerBuilder;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\Security\Auth\EventListener\UserRefreshListener;
use Jadob\Security\Auth\UserStorage;

/**
 * Class AuthProvider
 * @package Jadob\Security\Auth\ServiceProvider
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class AuthProvider implements ServiceProviderInterface
{

    /**
     * {@inheritdoc}
     */
    public function getConfigNode()
    {
        // TODO: Implement getConfigNode() method.
    }

    /**
     * {@inheritdoc}
     */
    public function register(ContainerBuilder $container, $config)
    {
        $container->add('auth.user.storage', function (Container $container) {
            return new UserStorage($container->get('session'));
        });


    }

    /**
     * {@inheritdoc}
     */
    public function onContainerBuild(Container $container, $config)
    {

        $container
            ->get('event.listener')
            ->addListener(
                new UserRefreshListener(
                    $container->get('guard'),
                    $container->get('auth.user.storage')
                ), 22
            )
        ;
    }
}
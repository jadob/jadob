<?php

namespace Jadob\Security\Guard\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\ContainerBuilder;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;

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
        // TODO: Implement register() method.
    }

    /**
     * [@inheritdoc}
     */
    public function onContainerBuild(Container $container, $config)
    {
        // TODO: Implement onContainerBuild() method.
    }
}
<?php

namespace Jadob\CommandBus\ServiceProvider;

use Jadob\CommandBus\CommandBus;
use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;

/**
 * Provides command bus to container.
 * @package Jadob\CommandBus\ServiceProvider
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class CommandBusProvider implements ServiceProviderInterface
{

    /**
     * {@inheritdoc}
     */
    public function getConfigNode()
    {
        return null;
    }

    /**
     * @param Container $container
     * @param array|null $config
     * @throws \Jadob\CommandBus\Exception\CommandBusException
     */
    public function register(Container $container, $config)
    {
        $container->add('command_bus', new CommandBus());
    }
}
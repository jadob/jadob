<?php

namespace Jadob\SymfonyConsoleBridge\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\ContainerBuilder;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\Core\Kernel;
use Jadob\Stdlib\StaticEnvironmentUtils;
use Symfony\Component\Console\Application;

/**
 * Adds symfony/console functionality to framework.
 * @see https://symfony.com/doc/3.4/components/console.html
 * @package Jadob\SymfonyConsoleBridge\ServiceProvider
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class ConsoleProvider implements ServiceProviderInterface
{

    /**
     * {@inheritdoc}
     */
    public function getConfigNode()
    {
        // TODO: Implement getConfigNode() method.
    }

    /**
     * @param Container $container
     * @param null $config
     */
    public function register(ContainerBuilder $container, $config)
    {
//        if (StaticEnvironmentUtils::isCli()) {
            $container->add('console', new Application('Jadob', Kernel::VERSION));
//        }
    }

    /**
     * {@inheritdoc}
     */
    public function onContainerBuild(Container $container, $config)
    {

    }
}
<?php

namespace Jadob\Core\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\ContainerBuilder;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\Debug\Profiler\EventListener\ProfilerListener;
use Jadob\EventListener\EventListener;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * Configures any Framework related things.
 * Class FrameworkServiceProvider
 * @package Jadob\Core\ServiceProvider
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class FrameworkServiceProvider implements ServiceProviderInterface
{

    /**
     * @return mixed|null
     */
    public function getConfigNode()
    {
        return 'framework';
    }

    /**
     * @param ContainerBuilder $container
     * @param $config
     * @return mixed|void
     */
    public function register($config)
    {
        return [
            SessionInterface::class => new Session()
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function onContainerBuild(Container $container, $config)
    {
        //enable development-only features
        if (isset($config['dev'])) {
            /** @var EventListener $eventListener */
            $eventListener = $container->get('event.listener');

//            $eventListener->addListener(new ProfilerListener(
//                $container->get('router'),
//                $container->get('profiler')
//            ));

        }

        //@TODO: add custom Monolog Handler Interfaces and register it


    }
}
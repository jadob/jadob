<?php


namespace Slice\Debug\ServiceProvider;


use Slice\Container\Container;
use Slice\Container\ServiceProvider\ServiceProviderInterface;
use Slice\Debug\Profiler\ProfilerListener;
use Slice\EventListener\EventListener;

class DebugServiceProvider implements ServiceProviderInterface
{

    /**
     * @return mixed
     */
    public function getConfigNode()
    {
       return null;
    }

    /**
     * @param Container $container
     * @param $config
     * @return mixed
     */
    public function register(Container $container, $config)
    {
        //$container->get('event.listener')->register(EventListener::EVENT_AFTER_CONTROLLER, new ProfilerListener(), 0);
    }
}
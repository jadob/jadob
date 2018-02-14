<?php


namespace Jadob\Debug\ServiceProvider;


use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\Debug\Profiler\ProfilerListener;
use Jadob\EventListener\EventListener;

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
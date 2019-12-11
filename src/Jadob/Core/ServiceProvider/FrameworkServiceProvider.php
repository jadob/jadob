<?php

namespace Jadob\Core\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\ContainerBuilder;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

/**
 * @deprecated - remove when better space for session will be found
 * Configures any Framework related things.
 * Class FrameworkServiceProvider
 * @package    Jadob\Core\ServiceProvider
 * @author     pizzaminded <miki@appvende.net>
 * @license    MIT
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
     * @param  $config
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


    }
}
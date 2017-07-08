<?php

namespace Slice\Core\ServiceProvider;

use Slice\Container\Container;
use Slice\Container\ServiceProvider\ServiceProviderInterface;
use Slice\Core\HTTP\Request;
use Slice\Core\Session\SessionHandler;

/**
 * Class TopLevelDepedenciesServiceProvider
 * @package Slice\Core\ServiceProvider
 */
class TopLevelDepedenciesServiceProvider implements ServiceProviderInterface
{
    /**
     * @param Container $container
     * @param array $configuration
     */
    public function register(Container $container, array $configuration)
    {
        $container
            ->add('request', Request::createFromGlobals())
            ->add('session', new SessionHandler());
    }
}
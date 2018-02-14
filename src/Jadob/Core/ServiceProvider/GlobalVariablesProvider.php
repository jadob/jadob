<?php

namespace Jadob\Core\ServiceProvider;


use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\Core\Services\GlobalVariables;

/**
 * Class GlobalVariablesProvider
 * @package Jadob\Core\ServiceProvider
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class GlobalVariablesProvider implements ServiceProviderInterface
{

    /**
     * @return mixed
     */
    public function getConfigNode()
    {
        return 'globals';
    }

    /**
     * @TODO: should i add environment here?
     * @param Container $container
     * @param $config
     * @return mixed
     */
    public function register(Container $container, $config)
    {
        $container->add('globals', new GlobalVariables($config));
    }
}
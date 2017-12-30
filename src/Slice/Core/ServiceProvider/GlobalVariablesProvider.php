<?php

namespace Slice\Core\ServiceProvider;


use Slice\Container\Container;
use Slice\Container\ServiceProvider\ServiceProviderInterface;
use Slice\Core\Services\GlobalVariables;

/**
 * Class GlobalVariablesProvider
 * @package Slice\Core\ServiceProvider
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
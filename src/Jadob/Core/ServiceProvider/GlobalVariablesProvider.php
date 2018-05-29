<?php

namespace Jadob\Core\ServiceProvider;


use Jadob\Container\Container;
use Jadob\Container\Definition;
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
     * @return void
     */
    public function register(Container $container, $config)
    {
        $container->addDefinition(new Definition('globals', GlobalVariables::class, [$config]));
    }
}
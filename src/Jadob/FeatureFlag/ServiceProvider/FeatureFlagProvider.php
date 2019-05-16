<?php

namespace Jadob\FeatureFlag\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;

/**
 * Class FeatureFlagProvider
 * @package Jadob\FeatureFlag\ServiceProvider
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class FeatureFlagProvider implements ServiceProviderInterface
{

    /**
     * {@inheritdoc}
     */
    public function getConfigNode()
    {
       return 'feature_flags';
    }

    /**
     * {@inheritdoc}
     */
    public function register($config)
    {
        // TODO: Implement register() method.
    }

    /**
     * {@inheritdoc}
     */
    public function onContainerBuild(Container $container, $config)
    {
        // TODO: Implement onContainerBuild() method.
    }
}
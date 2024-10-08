<?php
declare(strict_types=1);

namespace Jadob\FeatureFlag\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\FeatureFlag\FeatureFlag;

/**
 * Class FeatureFlagProvider
 *
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
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
     *
     * @return FeatureFlag[]
     *
     * @psalm-return array{Jadob\FeatureFlag\FeatureFlag: FeatureFlag}
     */
    public function register($config)
    {
        return [
            FeatureFlag::class => new FeatureFlag($config)
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function onContainerBuild(Container $container, $config)
    {
        // TODO: Implement onContainerBuild() method.
    }
}
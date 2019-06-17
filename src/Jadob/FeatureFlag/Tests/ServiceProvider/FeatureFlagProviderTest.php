<?php

namespace Jadob\FeatureFlag\Tests\ServiceProvider;

use Jadob\Container\Container;
use Jadob\FeatureFlag\FeatureFlag;
use Jadob\FeatureFlag\ServiceProvider\FeatureFlagProvider;
use PHPUnit\Framework\TestCase;

class FeatureFlagProviderTest extends TestCase
{
    public function testServiceProvider()
    {
        $provider = new FeatureFlagProvider();

        //config node
        $this->assertEquals('feature_flags', $provider->getConfigNode());

        $config = [
            'feature_1' => [
                'enabled' => true
            ]
        ];

        //registering
        $services = $provider->register($config);
        $this->assertCount(1, $services);
        $this->assertInstanceOf(FeatureFlag::class, \reset($services));
        $this->assertNull($provider->onContainerBuild(new Container(), $config));

    }
}
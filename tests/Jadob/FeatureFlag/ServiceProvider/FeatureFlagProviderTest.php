<?php

declare(strict_types=1);

namespace Jadob\FeatureFlag\ServiceProvider;

use Jadob\Container\Container;
use Jadob\FeatureFlag\FeatureFlag;
use PHPUnit\Framework\TestCase;

class FeatureFlagProviderTest extends TestCase
{
    public function testServiceProvider(): void
    {
        $provider = new FeatureFlagProvider();

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
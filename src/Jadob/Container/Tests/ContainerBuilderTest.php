<?php

namespace Jadob\Container\Tests;

use Jadob\Container\Container;
use Jadob\Container\ContainerBuilder;
use Jadob\Container\Tests\Fixtures\ExampleService;
use Jadob\Container\Tests\Fixtures\ServiceProvider\AInvalidServiceProvider;
use Jadob\Container\Tests\Fixtures\ServiceProvider\AServiceProvider;
use Jadob\Container\Tests\Fixtures\YetAnotherExampleService;
use PHPUnit\Framework\TestCase;

class ContainerBuilderTest extends TestCase
{
    public function testClosureAddedViaMethodWillBeAddedToFactories(): void
    {

        $factory = static function (): Fixtures\ExampleService {
            return new ExampleService();
        };

        $builder = new ContainerBuilder();
        $builder->add('dummy', $factory);

        $this->assertArrayHasKey('dummy', $factories = $builder->getFactories());
        $this->assertEquals($factory, $factories['dummy']);
        $this->assertTrue($builder->has('dummy'));

    }

    public function testContainerBuildingWithoutConfigPassed(): void
    {
        $builder = new ContainerBuilder();

        $builder->setServiceProviders([AServiceProvider::class]);

        $container = $builder->build();

        $this->assertInstanceOf(ExampleService::class, $container->get('a.1'));
        $this->assertInstanceOf(YetAnotherExampleService::class, $container->get('a.2'));

    }

    public function testBuildWillBreakWhenInvalidProviderPassed(): void
    {
        $this->expectException(\Jadob\Container\Exception\ContainerBuildException::class);
        $this->expectDeprecationMessage('Class Jadob\Container\Tests\Fixtures\ServiceProvider\AInvalidServiceProvider cannot be used as an service provider');
        $builder = new ContainerBuilder();

        $builder->setServiceProviders([AInvalidServiceProvider::class]);

        $container = $builder->build();
    }
}
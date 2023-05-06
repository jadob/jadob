<?php

namespace Jadob\Container;

use Jadob\Container\Fixtures\ExampleService;
use Jadob\Container\Fixtures\ServiceProvider\AInvalidServiceProvider;
use Jadob\Container\Fixtures\ServiceProvider\AServiceProvider;
use Jadob\Container\Fixtures\YetAnotherExampleService;
use PHPUnit\Framework\TestCase;

class ContainerBuilderTest extends TestCase
{

    /**
     * @group container
     * @group container-definitions
     * @group container-service-providers
     * @group container-builder
     * @return void
     * @throws Exception\ContainerBuildException
     * @throws Exception\ContainerException
     * @throws Exception\ServiceNotFoundException
     */
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
        $this->expectExceptionMessage('Class Jadob\Container\Fixtures\ServiceProvider\AInvalidServiceProvider cannot be used as an service provider');
        $builder = new ContainerBuilder();

        $builder->setServiceProviders([AInvalidServiceProvider::class]);
        $builder->build();
    }
}
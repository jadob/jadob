<?php

namespace Jadob\Container\Tests;

use Jadob\Container\Container;
use Jadob\Container\Definition;
use Jadob\Container\Tests\Fixtures\ExampleService;
use Jadob\Container\Tests\Fixtures\YetAnotherExampleService;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

/**
 * Class DefinitionTest
 * @package Jadob\Container\Tests
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class DefinitionTest extends TestCase
{

    public function testServiceCreating()
    {
        $container = new Container();
        $container->add(ExampleService::class, $example = new ExampleService());


        $factory = function (ContainerInterface $container) {
            return new YetAnotherExampleService();
        };

        $definition = new Definition($factory);

        $definition->addMethodCall('setService', [$example]);
        /** @var YetAnotherExampleService $createdService */
        $createdService = $definition->create($container);

        $this->assertInstanceOf(YetAnotherExampleService::class, $createdService);
        $this->assertSame($example, $createdService->getService());

        $createdService = $definition->create($container);

        $this->assertInstanceOf(YetAnotherExampleService::class, $createdService);
        $this->assertSame($example, $createdService->getService());

    }

    public function testScalarCreating()
    {
        $container = new Container();
        $container->add(ExampleService::class, $example = new ExampleService());

        $definition = new Definition('hello');


        $createdService = $definition->create($container);

        $this->assertEquals('hello', $createdService);


    }

}
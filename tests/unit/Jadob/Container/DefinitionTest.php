<?php

namespace Jadob\Container;

use Jadob\Container\Fixtures\ExampleService;
use Jadob\Container\Fixtures\YetAnotherExampleService;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;

/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class DefinitionTest extends TestCase
{

    public function testServiceCreating(): void
    {
        $container = new Container();
        $container->add(ExampleService::class, $example = new ExampleService());


        $factory = function (ContainerInterface $container): YetAnotherExampleService {
            return new YetAnotherExampleService();
        };

        $definition = new Definition($factory);

        $definition->addMethodCall('setService', [$example]);
        /**
 * @var YetAnotherExampleService $createdService 
*/
        $createdService = $definition->create($container);

        $this->assertInstanceOf(YetAnotherExampleService::class, $createdService);
        $this->assertSame($example, $createdService->getService());

        $createdService = $definition->create($container);

        $this->assertInstanceOf(YetAnotherExampleService::class, $createdService);
        $this->assertSame($example, $createdService->getService());

    }

    public function testScalarCreating(): void
    {
        $container = new Container();
        $container->add(ExampleService::class, $example = new ExampleService());

        $definition = new Definition('hello');


        $createdService = $definition->create($container);

        $this->assertEquals('hello', $createdService);


    }

}
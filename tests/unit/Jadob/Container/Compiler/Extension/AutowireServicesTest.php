<?php

namespace Jadob\Container\Compiler\Extension;

use Jadob\Container\Fixtures\ClassWithoutConstructor;
use Jadob\Container\ServiceGraph;
use Jadob\Contracts\DependencyInjection\ServiceDefinition;
use PHPUnit\Framework\TestCase;

class AutowireServicesTest extends TestCase
{

    public function testServiceWithoutConstructorWouldNotHaveAnyArgumentsAdded(): void
    {
        $definition = new ServiceDefinition(
            ClassWithoutConstructor::class,
            ClassWithoutConstructor::class,
        );

        $graph = new ServiceGraph();
        $graph->add($definition);

        $autowire = new AutowireServices();
        $autowire->onContainerBuild($graph);

        self::assertCount(0, $definition->arguments);

    }

}
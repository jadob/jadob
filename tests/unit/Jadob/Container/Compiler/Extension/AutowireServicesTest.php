<?php

declare(strict_types=1);

namespace Jadob\Container\Compiler\Extension;

use Jadob\Container\Fixtures\ClassWithoutConstructor;
use Jadob\Container\ServiceGraph;
use Jadob\Contracts\DependencyInjection\ServiceDefinition;
use PHPUnit\Framework\TestCase;

/**
 * IMPORTANT: Remember to invoke autowire() on tested definition.
 */
final class AutowireServicesTest extends TestCase
{

    public function testServiceWithoutConstructorWouldNotHaveAnyArgumentsAdded(): void
    {
        $definition = new ServiceDefinition(
            ClassWithoutConstructor::class,
            ClassWithoutConstructor::class,
        )->autowire();

        $graph = new ServiceGraph();
        $graph->add($definition);

        $autowire = new AutowireServices();
        $autowire->onContainerBuild($graph);

        self::assertCount(0, $definition->arguments);

    }

}
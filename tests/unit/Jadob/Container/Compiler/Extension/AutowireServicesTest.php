<?php

declare(strict_types=1);

namespace Jadob\Container\Compiler\Extension;

use Jadob\Container\Compiler\Exception\ContainerCompilerException;
use Jadob\Container\Fixtures\ClassWithBuiltinNonNullableArgument;
use Jadob\Container\Fixtures\ClassWithBuiltinNullableArgument;
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

    public function testNullableBuiltinTypesWithoutHintsWillBeDefaultedToNull(): void
    {
        $definition = new ServiceDefinition(
            ClassWithBuiltinNullableArgument::class,
            ClassWithBuiltinNullableArgument::class,
        )->autowire();

        $graph = new ServiceGraph();
        $graph->add($definition);

        $autowire = new AutowireServices();
        $autowire->onContainerBuild($graph);

        self::assertNull($definition->arguments['name']->value);
    }

    public function testNonNullableBuiltinTypesWithoutHintsWillRaiseAnException(): void
    {
        $definition = new ServiceDefinition(
            ClassWithBuiltinNonNullableArgument::class,
            ClassWithBuiltinNonNullableArgument::class,
        )->autowire();

        $graph = new ServiceGraph();
        $graph->add($definition);

        $autowire = new AutowireServices();

        $this->expectException(ContainerCompilerException::class);
        $this->expectExceptionMessage(
            'Unable to autowire service "Jadob\Container\Fixtures\ClassWithBuiltinNonNullableArgument" as argument '.
            '"name" is a built-in and has no argument/inject hints defined.'
        );

        $autowire->onContainerBuild($graph);

    }

}
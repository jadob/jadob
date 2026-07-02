<?php

declare(strict_types=1);

namespace Jadob\Contracts\DependencyInjection;

use ReflectionAttribute;

/**
 * Allows to override default behavior during constructor autowiring.
 */
interface ConstructorInjectionExtensionInterface
{
    /**
     * @param class-string $class
     * @param list<ReflectionAttribute<object>> $argumentAttributes
     */
    public function supportsConstructorInjectionFor(
        string $class,
        string $argumentName,
        string $argumentType,
        array $argumentAttributes,
    ): bool;

    /**
     * @param class-string $class
     * @param list<ReflectionAttribute<object>> $argumentAttributes
     */
    public function injectConstructorArgument(
        string $class,
        string $argumentName,
        string $argumentType,
        array $argumentAttributes,
    ): object;
}

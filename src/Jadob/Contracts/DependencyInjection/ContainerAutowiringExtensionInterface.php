<?php

declare(strict_types=1);

namespace Jadob\Contracts\DependencyInjection;

use Attribute;

/**
 * Allows to override default behavior during autowiring.
 * @license MIT
 */
interface ContainerAutowiringExtensionInterface
{
    /**
     * @param class-string $class
     * @param string $argumentName
     * @param string $argumentType
     * @param list<Attribute> $argumentAttributes
     * @return bool
     */
    public function supportsConstructorInjectionFor(
        string $class,
        string $argumentName,
        string $argumentType,
        array $argumentAttributes
    ): bool;

    /**
     * Whatever is returned here, it would be injected into the service.
     *
     * @param class-string $class
     * @param string $argumentName
     * @param string $argumentType
     * @param list<Attribute> $argumentAttributes
     * @return object
     */
    public function injectConstructorArgument(
        string $class,
        string $argumentName,
        string $argumentType,
        array $argumentAttributes
    ): object;
}


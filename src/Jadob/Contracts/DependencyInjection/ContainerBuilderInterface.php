<?php

namespace Jadob\Contracts\DependencyInjection;

use Closure;

interface ContainerBuilderInterface
{
    public function set(
        string $id,
        ?string $class = null,
    ): ServiceDefinition;

    /**
     * @param class-string $type
     * @param string $serviceId id of service to be bound to type
     * @return void
     */
    public function bind(
        string $type,
        string $serviceId
    ): void;

    public function alias(
        string $alias,
        string $serviceId
    ): void;

    /**
     * @param Closure $callable
     * @return void
     */
    public function loadConfig(
        Closure $callable
    ): void;

    public function registerServiceProvider(
        ServiceProviderInterface $serviceProvider
    ): void;

    public function createEnvReference(
        string $name
    ): Reference;

    public function requireParameter(
        string $name,
    );

    public function addFallbackParameter(
        string $name,
        mixed $value
    );
}
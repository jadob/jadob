<?php

namespace Jadob\Contracts\DependencyInjection;

interface ContainerBuilderInterface
{
    public function set(
        string $id,
        ?string $className = null,
    ): ServiceDefinition;

    public function replace(
        string $id,
        ?string $className = null
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
        string $serviceId,
        string $alias,
    ): void;

    public function registerServiceProvider(
        ServiceProviderInterface $serviceProvider
    ): void;

    public function requireParameter(
        string $name,
    );

    public function addFallbackParameter(
        string $name,
        mixed $value
    );
}
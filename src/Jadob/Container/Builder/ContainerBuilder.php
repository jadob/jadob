<?php

namespace Jadob\Container\Builder;

use Closure;
use Jadob\Contracts\DependencyInjection\ContainerBuilderInterface;
use Jadob\Contracts\DependencyInjection\Reference;
use Jadob\Contracts\DependencyInjection\ServiceDefinition;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;

final class ContainerBuilder implements ContainerBuilderInterface
{
    /**
     * @var array<non-empty-string|class-string, ServiceDefinition>
     */
    private array $definitions = [];

    private array $configs = [];

    private array $serviceProviders = [];

    private array $requiredParameters = [];

    private array $fallbackParameters = [];

    /**
     * @var array<class-string, non-empty-string|class-string>
     */
    private array $bindings = [];

    /**
     * @var array<non-empty-string, non-empty-string|class-string>
     */
    private array $aliases = [];

    public function set(
        string  $id,
        ?string $className = null,
    ): ServiceDefinition
    {
        if ($id === '') {
            throw new ContainerBuildException('A service ID cannot be empty.');
        }

        if (isset($this->definitions[$id])) {
            throw new ContainerBuildException(
                sprintf(
                    'Service "%s" is already defined; use replace() to override it.',
                    $id,
                ));
        }

        if ($className === null && \class_exists($id)) {
            $className = $id;
        }

        if ($className === null && \interface_exists($id)) {
            throw new ContainerBuildException(
                \sprintf(
                    'Service "%s" is an interface, register a concrete implementation and use bind() to map it to interface.',
                    $id,
                )
            );
        }

        return $this->definitions[$id] = new ServiceDefinition(
            $id,
            $className
        );

    }

    public function replace(
        string  $id,
        ?string $className = null
    ): ServiceDefinition
    {
        unset($this->definitions[$id]);

        return $this->set($id, $className);
    }

    /**
     * @param class-string $type
     * @param string $serviceId
     * @return void
     */
    public function bind(string $type, string $serviceId): void
    {
        $this->bindings[$type] = $serviceId;
    }

    public function alias(string $serviceId, string $alias): void
    {
        $this->aliases[$alias] = $serviceId;
    }


    public function registerServiceProvider(ServiceProviderInterface $serviceProvider): void
    {
        $this->serviceProviders[] = $serviceProvider;
    }

    public function createEnvReference(string $name): Reference
    {
        return Reference::env($name);
    }

    public function loadConfiguration(
        Closure $config
    ): self
    {
        $this->configs[] = $config;

        return $this;
    }

    public function requireParameter(string $name,): void
    {
        $this->requiredParameters[] = $name;
    }

    public function addFallbackParameter(string $name, mixed $value): void
    {
        $this->fallbackParameters[$name] = $value;
    }

    public function getServiceProviders(): array
    {
        return $this->serviceProviders;
    }

    public function getRequiredParameters(): array
    {
        return $this->requiredParameters;
    }

    public function getFallbackParameters(): array
    {
        return $this->fallbackParameters;
    }

}
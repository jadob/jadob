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
        string $id,
        ?string $class = null,
    ): ServiceDefinition
    {

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

    public function alias(string $alias, string $serviceId): void
    {
        $this->aliases[$alias] = $serviceId;
    }

    public function loadConfig(Closure $callable): void
    {
        // TODO: Implement loadConfig() method.
    }

    public function registerServiceProvider(ServiceProviderInterface $serviceProvider): void
    {
        $this->serviceProviders[] = $serviceProvider;
    }

    public function createEnvReference(string $name): Reference
    {
        return Reference::env($name);
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
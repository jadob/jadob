<?php

namespace Jadob\Container\Builder;

use Closure;
use Jadob\Container\Builder\Exception\ContainerBuildException;
use Jadob\Contracts\DependencyInjection\ContainerBuilderInterface;
use Jadob\Contracts\DependencyInjection\Reference;
use Jadob\Contracts\DependencyInjection\ServiceDefinition;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use function sprintf;

final class ContainerBuilder implements ContainerBuilderInterface
{
    /**
     * @var array<non-empty-string|class-string, ServiceDefinition>
     */
    private array $definitions = [];

    /**
     * @var array<Closure>
     */
    private array $configurations = [];

    private array $serviceProviders = [];

    private array $requiredParameters = [];

    private array $fallbackParameters = [];

    /**
     * @var array<non-empty-string, NamespaceScanConfigurator>
     */
    private array $namespaceScans = [];

    /**
     * @var array<class-string, non-empty-string|class-string>
     */
    private array $bindings = [];

    /**
     * @var array<non-empty-string, non-empty-string|class-string>
     */
    private array $aliases = [];

    /**
     * @throws ContainerBuildException
     */
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

    public function loadConfiguration(
        Closure $config
    ): self
    {
        $this->configurations[] = $config;

        return $this;
    }

    public function requireParameter(string $name): void
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

    public function getDefinitions(): array
    {
        return $this->definitions;
    }

    /**
     * @return array<class-string, non-empty-string>
     */
    public function getBindings(): array
    {
        return $this->bindings;
    }

    /**
     * @return array<non-empty-string, non-empty-string|class-string>
     */
    public function getAliases(): array
    {
        return $this->aliases;
    }

    /**
     * @return array<Closure>
     */
    public function popConfigurations(): array
    {
        $configs = $this->configurations;
        $this->configurations = [];
        return $configs;
    }

    public function configureNamespaceScan(): NamespaceScanConfigurator
    {
        $scanner = new NamespaceScanConfigurator();
        $this->namespaceScans[] = $scanner;

        return $scanner;
    }

    /**
     * @return array<NamespaceScanConfigurator>
     */
    public function getNamespaceScans(): array
    {
        return $this->namespaceScans;
    }
}
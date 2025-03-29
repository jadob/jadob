<?php

declare(strict_types=1);

namespace Jadob\Container;

use Closure;
use Jadob\Container\Exception\ContainerException;
use Jadob\Container\Exception\ContainerLogicException;
use Jadob\Container\Exception\ServiceNotFoundException;
use Jadob\Contracts\DependencyInjection\Definition;
use Jadob\Contracts\DependencyInjection\ServiceProviderHandlerInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Psr\Container\ContainerInterface;
use ReflectionClass;
use ReflectionFunction;
use ReflectionNamedType;
use function is_array;

class Container implements ContainerInterface, ServiceProviderHandlerInterface
{
    private array $resolvingChain = [];

    /**
     * @var array<ServiceProviderInterface>
     */
    private array $serviceProviders = [];

    /**
     * @var array<class-string,list<class-string|string>>
     */
    private array $interfaceMap = [];

    /**
     * @var array<class-string,list<class-string|string>>
     */
    private array $classMap = [];

    /**
     * @var array<string|class-string, Definition>
     */
    private array $definitions = [];

    /**
     * @var list<object>
     */
    private array $instances = [];

    /**
     * @throws ContainerException
     * @throws \ReflectionException
     */
    public function add(string $id, null|object|array $service): void
    {
        $fqcnUsedAsId = true;
        if (!class_exists($id)) {
            $fqcnUsedAsId = false;
        }

        if ($service === null) {
            if (!$fqcnUsedAsId) {
                throw new ContainerException(
                    sprintf('Class "%s" does not exist.', $id)
                );
            }

            $this->updateInterfaceMap($id, $id);
            $this->definitions[$id] = Definition::create()
                ->setClassName($id);

            return;
        }

        if(is_array($service)) {
            $service = self::createDefinition($id, $service);
        }

        if ($service instanceof Definition) {
            $this->updateInterfaceMap($service->getClassName(), $id);
            $this->updateClassMap($service->getClassName(), $id);
            $this->definitions[$id] = $service;
            return;
        }

        $this->updateClassMap(get_class($service), $id);
        $this->updateInterfaceMap(get_class($service), $id);

        $definition = Definition::create()
            ->setFactory(
                $this->wrapServiceIntoFactory($service)
            );

        if ($fqcnUsedAsId) {
            $definition->setClassName($id);
        }

        $this->definitions[$id] = $definition;
    }


    private function wrapServiceIntoFactory(object $service): Closure
    {
        if ($service instanceof Closure) {
            return $service;
        }

        return function () use ($service) {
            return $service;
        };
    }

    private function updateInterfaceMap(string $class, string $id): void
    {
        /** @var list<class-string> $interfaces */
        $interfaces = array_values(
            class_implements($class)
        );


        foreach ($interfaces as $interface) {
            if (!array_key_exists($interface, $this->interfaceMap)) {
                $this->interfaceMap[$interface] = [];
            }

            $this->interfaceMap[$interface][] = $id;
        }
    }

    private function updateClassMap(string $class, string $id): void
    {
        if (!array_key_exists($class, $this->classMap)) {
            $this->classMap[$class] = [];
        }

        $this->classMap[$class][] = $id;
    }

    private function sharedInstanceExists(string $className): bool
    {
        return array_key_exists($className, $this->instances);
    }


    public function get(string $id)
    {
        return $this->doGet($id, true);
    }

    /**
     * Creates a service from factory, or makes from scratch.
     * @param Definition $definition
     * @return object
     */
    private function resolveDefinition(Definition $definition): object
    {
        $factory = $definition->getFactory();
        if ($factory !== null) {
            return $this->instantiate($factory);
        }

        return $this->make($definition->getClassName());
    }


    /**
     * @param string $className
     * @return object
     * @throws \ReflectionException
     */
    private function make(string $className): object
    {
        $reflectionClass = new ReflectionClass($className);
        $constructor = $reflectionClass->getConstructor();

        if ($constructor === null) {
            return $reflectionClass->newInstance();
        }

        try {
            $resolvedArguments = [];
            $constructorParameters = $constructor->getParameters();

            foreach ($constructorParameters as $parameter) {
                /** @var ReflectionNamedType $parameterClass */
                $parameterClass = $parameter->getType();
                $resolvedArguments[] = $this->doGet($parameterClass->getName());
            }

            return $reflectionClass->newInstanceArgs($resolvedArguments);
        } catch (ServiceNotFoundException $e) {
            throw new ContainerLogicException(
                sprintf(
                    'Unable to autowire service "%s" (Resolving chain: %s)',
                    $className,
                    implode(' -> ', $e->getResolvingChain())
                )
            );
        }
    }


    /**
     *
     * @param string $id
     * @param bool $public
     * @return object
     * @throws ContainerException
     * @throws ServiceNotFoundException
     */
    private function doGet(string $id, bool $public = false): object
    {
        $this->resolvingChain[] = $id;

        /**
         * Service requested by its interface FQCN
         */
        if (!$this->definitionExists($id) && interface_exists($id)) {
            $implementations = $this->interfaceMap[$id] ?? [];
            $definition = match (count($implementations)) {
                1 => $this->definitions[$implementations[0]],
                0 => throw new ServiceNotFoundException(
                    sprintf('Interface "%s" does not have any implementations provided in container', $id),
                    $this->resolvingChain
                ),
                default => throw new ContainerException(
                    sprintf('Interface "%s" have multiple implementations, cannot determine which one to use.', $id),
                )
            };
        } elseif (!$this->definitionExists($id) && class_exists($id)) {
            $classes = $this->classMap[$id] ?? [];
            $definition = match (count($classes)) {
                1 => $this->definitions[$classes[0]],
                0 => throw new ServiceNotFoundException(
                    sprintf('Class "%s" does not have any implementations provided in container', $id),
                    $this->resolvingChain
                ),
                default => throw new ContainerException(
                    sprintf('Class "%s" have multiple implementations, cannot determine which one to use.', $id)
                )
            };
        } elseif (array_key_exists($id, $this->definitions)) {
            $definition = $this->definitions[$id];
        } else {
            throw new ServiceNotFoundException(
                sprintf('Service "%s" not found in container.', $id),
                $this->resolvingChain
            );
        }

        if ($public && $definition->isPrivate()) {
            throw new ContainerLogicException('Cannot access private service "' . $id . '".');
        }

        $shared = $definition->isShared();
        if ($shared && $this->sharedInstanceExists($id)) {
            return $this->onServiceResolved(
                $id,
                $this->instances[$id]
            );
        }

        $resolvedService = $this->resolveDefinition($definition);

        if (!$shared) {
            return $this->onServiceResolved(
                $id,
                $resolvedService
            );
        }

        $this->instances[$id] = $resolvedService;
        return $this->onServiceResolved(
            $id,
            $resolvedService
        );
    }


    /**
     * This must be called on every return from doGet.
     * @param string $id
     * @param object $resolvedService
     * @return object
     */
    private function onServiceResolved(
        string $id,
        object $resolvedService,
    ): object
    {
        array_pop($this->resolvingChain);
        return $resolvedService;
    }

    private function instantiate(Closure $factory): object
    {
        $reflection = new ReflectionFunction($factory);
        $reflectionParameters = $reflection->getParameters();

        $parametersToInject = [];
        foreach ($reflectionParameters as $parameter) {
            $className = $parameter->getType()->getName();

            if ($this->has($className)) {
                $parametersToInject[] = $this->get($className);
                continue;
            }

            if ($className === ContainerInterface::class) {
                $parametersToInject[] = $this;
                continue;
            }

            throw new ContainerException('Undefined behavior');
        }

        return $factory(...$parametersToInject);
    }

    private function definitionExists(string $id): bool
    {
        return array_key_exists($id, $this->definitions);
    }

    public function has(string $id): bool
    {
        return array_key_exists($id, $this->definitions)
            || array_key_exists($id, $this->classMap)
            || array_key_exists($id, $this->interfaceMap);
    }

    /**
     * @throws \ReflectionException
     * @throws ContainerException
     */
    public static function fromArrayConfiguration(array $configuration): Container
    {
        $container = new Container();

        foreach ($configuration['services'] ?? [] as $serviceId => $serviceConfig) {
            if ($serviceConfig instanceof Definition) {
                throw new ContainerException(
                    'Passing definitions directly not supported yet.'
                );
            }

            $container->add(
                $serviceId,
                self::createDefinition(
                    $serviceId,
                    $serviceConfig
                )
            );
        }

        return $container;
    }


    /**
     * @throws \ReflectionException
     * @throws ContainerException
     */
    private static function createDefinition(
        string $serviceId,
        array|object $serviceConfig,
    ): Definition
    {
        $definition = Definition::create();

        if ($serviceConfig instanceof Closure) {
            $definition->setFactory($serviceConfig);
            $closureReflection = new ReflectionFunction($serviceConfig);
            $returnType = $closureReflection->getReturnType();

            if ($returnType instanceof ReflectionNamedType) {
                $definition->setClassName($returnType->getName());
            }
        } elseif (is_object($serviceConfig)) {
            $definition->setClassName(get_class($serviceConfig));
            $definition->setFactory(static function () use ($serviceConfig) {
                return $serviceConfig;
            });
        } elseif (is_array($serviceConfig)) {
            if(array_key_exists('class', $serviceConfig) && class_exists($serviceConfig['class'])) {
                $definition->setClassName($serviceConfig['class']);
            } elseif (class_exists($serviceId)) {
                $definition->setClassName($serviceId);
            }

            if (array_key_exists('factory', $serviceConfig)) {
                $definition->setFactory($serviceConfig['factory']);
            }

            $definition->setAutowired($serviceConfig['autowire'] ?? false);
        } else {
            throw new ContainerException(
                sprintf('Unable to build configuration for service id "%s" ', $serviceId)
            );
        }

        if ($definition->getClassName() === null) {
            throw new ContainerException(
                sprintf(
                    'Service "%s" does neither have a class name or factory return hint.',
                    $serviceId
                )
            );
        }

        return $definition;
    }


    public function registerServiceProvider(object $serviceProvider): void
    {
        $this->serviceProviders[get_class($serviceProvider)] = $serviceProvider;
    }

    public function overrideServiceProvider(
        string $providerClassToOverride,
        object $serviceProvider
    ): void
    {
        $this->serviceProviders[$providerClassToOverride] = $serviceProvider;
    }

    public function build(): void
    {
        $resolver = new ServiceProviderResolver();
        $orderedServiceProviders = $resolver->resolveServiceProvidersOrder($this->serviceProviders);
    }

    private function handleServiceProvider(object $serviceProvider): void
    {

    }
}
<?php

declare(strict_types=1);

namespace Jadob\Container;

use Closure;
use Jadob\Container\Exception\ContainerException;
use Jadob\Container\Exception\ContainerLogicException;
use Jadob\Container\Exception\ServiceNotFoundException;
use Jadob\Contracts\DependencyInjection\ContainerAutowiringExtensionInterface;
use Jadob\Contracts\DependencyInjection\Definition;
use Jadob\Contracts\DependencyInjection\ServiceProviderHandlerInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Psr\Container\ContainerInterface;
use ReflectionClass;
use ReflectionException;
use ReflectionFunction;
use ReflectionNamedType;
use function is_array;

class Container implements ContainerInterface, ServiceProviderHandlerInterface
{

    /**
     * @var array<ContainerAutowiringExtensionInterface>
     */
    private array $autowiringExtensions = [];

    /**
     * @var array<string|class-string>
     */
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
     * @throws ReflectionException
     */
    public function add(string $id, null|object|array $service): void
    {
        try {
            new ReflectionClass($id);
            $fqcnUsedAsId = true;
        } catch (ReflectionException) {
            $fqcnUsedAsId = false;
        }

        if ($service === null) {
            $this->addServiceFromClassName($id, $fqcnUsedAsId);
            return;
        }

        if (is_array($service)) {
            $this->addServiceFromArray($id, $service);
            return;
        }

        if ($service instanceof Definition) {
           $this->addServiceFromDefinition($id, $service);
           return;
        }

        if($service instanceof Closure) {
            $this->addServiceFromClosure($id, $service, $fqcnUsedAsId);
            return;
        }

        $this->addServiceFromInstantiatedClass($id, $service, $fqcnUsedAsId);
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


    public function get(string $id): object
    {
        return $this->doGet($id, true);
    }

    /**
     * Creates a service from factory, or makes from scratch.
     * @param Definition $definition
     * @return object
     * @throws ContainerException
     * @throws ReflectionException
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
     * @throws ReflectionException
     */
    private function make(string $className): object
    {
        $reflectionClass = new ReflectionClass($className);
        $constructor = $reflectionClass->getConstructor();

        if ($constructor === null) {
            return $reflectionClass->newInstance();
        }

        $resolvedArguments = [];
        $constructorParameters = $constructor->getParameters();

        foreach ($constructorParameters as $parameter) {
            /** @var ReflectionNamedType $parameterClass */
            $parameterClass = $parameter->getType();
            try {
                foreach ($this->autowiringExtensions as $extension) {
                    if ($extension->supportsConstructorInjectionFor(
                        class: $className,
                        argumentName: $parameter->getName(),
                        argumentType: $parameterClass->getName(),
                        argumentAttributes: $parameter->getAttributes()
                    )) {
                        $resolvedArguments[] = $extension->injectConstructorArgument(
                            class: $className,
                            argumentName: $parameter->getName(),
                            argumentType: $parameterClass->getName(),
                            argumentAttributes: $parameter->getAttributes()
                        );
                    }
                }


                $resolvedArguments[] = $this->doGet($parameterClass->getName());
            } catch (ServiceNotFoundException $e) {
                if ($parameterClass->allowsNull()) {
                    $resolvedArguments[] = null;
                    continue;
                }

                throw new ContainerLogicException(
                    sprintf(
                        'Unable to autowire service "%s" (Resolving chain: %s)',
                        $className,
                        implode(' -> ', $e->getResolvingChain())
                    )
                );
            }
        }

        return $reflectionClass->newInstanceArgs($resolvedArguments);
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
     * @throws ReflectionException
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
     * @throws ReflectionException
     * @throws ContainerException
     */
    private static function createDefinition(
        string       $serviceId,
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
            if (array_key_exists('class', $serviceConfig) && class_exists($serviceConfig['class'])) {
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
            throw ContainerLogicException::missingTypeHint($serviceId);
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

    /**
     * @throws ContainerException
     */
    public function resolveServiceProviders(array $config): void
    {
        $resolver = new ServiceProviderResolver();
        $orderedServiceProviders = $resolver->resolveServiceProvidersOrder($this->serviceProviders);

        foreach ($orderedServiceProviders as $serviceProviderFqcn) {
            $serviceProvider = $this->serviceProviders[$serviceProviderFqcn];
            $providerConfig = null;
            $requestedConfigNode = $serviceProvider->getConfigNode();
            if ($requestedConfigNode) {
                $providerConfig = $config[$requestedConfigNode];
            }

            $servicesToAdd = $serviceProvider->register($this, $providerConfig);
            foreach ($servicesToAdd as $serviceId => $serviceConfig) {
                $this->add($serviceId, $serviceConfig);
            }
        }
    }

    public function addAutowiringExtension(ContainerAutowiringExtensionInterface $extension): void
    {
        $this->autowiringExtensions[] = $extension;
    }


    /**
     * @throws ReflectionException
     */
    private function addDefinition(string $id, Definition $definition): void
    {
        $hasFactory = $definition->getFactory() !== null;
        $hasClassName = $definition->getClassName() !== null;

        if (
            (
                $hasFactory
                && !(new ReflectionFunction($definition->getFactory()))->hasReturnType()
            )
            && !$hasClassName
        ) {
            throw ContainerLogicException::missingTypeHint($id);
        }

        $this->definitions[$id] = $definition;
    }


    /**
     * @throws ReflectionException
     */
    private function addServiceFromClosure(string $id, Closure $closure, bool $fqcnUsedAsId): void
    {
        if($fqcnUsedAsId) {
            $className = $id;
        } else {
            $reflection = new ReflectionFunction($closure);
            if(!$reflection->hasReturnType()) {
                throw ContainerLogicException::missingTypeHint($id);
            }

            $className = $reflection->getReturnType()->getName();
        }

        $this->updateClassMap($className, $id);
        $this->updateInterfaceMap($className, $id);

        $definition = Definition::create()
            ->setFactory(
                $closure
            );

        if ($fqcnUsedAsId) {
            $definition->setClassName($id);
        }

        $this->addDefinition($id, $definition);
    }

    private function addServiceFromInstantiatedClass(string $id, object $service, bool $fqcnUsedAsId): void
    {
        $this->updateClassMap(get_class($service), $id);
        $this->updateInterfaceMap(get_class($service), $id);

        $definition = Definition::create()
            ->setFactory(
                $this->wrapServiceIntoFactory($service)
            );

        $definition->setClassName(match ($fqcnUsedAsId) {
            true => $id,
            false => get_class($service),
        });

        $this->addDefinition($id, $definition);
    }

    /**
     * @throws ReflectionException
     * @throws ContainerException
     */
    private function addServiceFromArray(string $id, array $config): void
    {
        $definition = self::createDefinition($id, $config);
        $this->addServiceFromDefinition($id, $definition);
    }

    private function addServiceFromDefinition(string $id, Definition $definition): void
    {
        $this->updateInterfaceMap($definition->getClassName(), $id);
        $this->updateClassMap($definition->getClassName(), $id);
        $this->addDefinition($id, $definition);
    }

    /**
     * @param string|class-string $id
     * @param bool $fqcnUsedAsId
     * @return void
     * @throws ReflectionException
     * @throws ContainerException
     */
    private function addServiceFromClassName(string $id, bool $fqcnUsedAsId): void
    {
        if (!$fqcnUsedAsId && !class_exists($id)) {
            throw new ContainerException(
                sprintf('Class "%s" does not exist.', $id)
            );
        }

        $this->updateInterfaceMap($id, $id);
        $this->addDefinition($id,
            Definition::create()
                ->setClassName($id)
        );
    }
}
<?php

declare(strict_types=1);

namespace Jadob\Container;

use Jadob\Container\Exception\ContainerLogicException;
use Jadob\Container\Exception\ServiceNotFoundException;
use Jadob\Contracts\DependencyInjection\ConstructorInjectionExtensionInterface;
use Jadob\Contracts\DependencyInjection\ExtendedContainerInterface;
use Psr\Container\ContainerInterface;
use ReflectionClass;
use ReflectionException;
use ReflectionNamedType;
use ReflectionUnionType;

class AutowiringContainer implements ExtendedContainerInterface
{
    /**
     * @var array<string, object>
     */
    private array $autowiredInstances = [];

    /**
     * @var array<string|class-string>
     */
    private array $resolvingChain = [];

    /**
     * @param list<ConstructorInjectionExtensionInterface> $injectionExtensions
     * @param list<string> $autowirableNamespacePrefixes
     */
    public function __construct(
        private readonly Container $inner,
        private array $injectionExtensions = [],
        private array $autowirableNamespacePrefixes = [],
    ) {
    }

    public function addAutowirableNamespacePrefix(string $prefix): self
    {
        $this->autowirableNamespacePrefixes[] = $prefix;

        return $this;
    }

    /**
     * @param list<string> $prefixes
     */
    public function setAutowirableNamespacePrefixes(array $prefixes): self
    {
        $this->autowirableNamespacePrefixes = $prefixes;

        return $this;
    }

    /**
     * @param list<ConstructorInjectionExtensionInterface> $injectionExtensions
     */
    public function setInjectionExtensions(array $injectionExtensions): self
    {
        $this->injectionExtensions = $injectionExtensions;

        return $this;
    }

    public function get(string $id): object
    {
        $cacheId = $this->inner->resolveServiceId($id) ?? $id;

        if ($this->inner->has($id)) {
            if (array_key_exists($cacheId, $this->autowiredInstances)) {
                return $this->autowiredInstances[$cacheId];
            }

            try {
                return $this->inner->get($id);
            } catch (ContainerLogicException $e) {
                $definition = $this->inner->getDefinition($id);
                if ($definition === null || $definition->getFactory() !== null) {
                    throw $e;
                }

                $instance = $this->make($definition->getClassName(), allowUnregistered: false);

                if ($definition->isShared()) {
                    $this->autowiredInstances[$cacheId] = $instance;
                }

                return $instance;
            }
        }

        if (class_exists($id)) {
            if (!$this->isWithinAutowirableNamespace($id)) {
                throw new ServiceNotFoundException(
                    sprintf('Service "%s" not found in container.', $id),
                    [$id]
                );
            }

            if (array_key_exists($id, $this->autowiredInstances)) {
                return $this->autowiredInstances[$id];
            }

            $instance = $this->make($id, allowUnregistered: true);
            $this->autowiredInstances[$id] = $instance;

            return $instance;
        }

        throw new ServiceNotFoundException(
            sprintf('Service "%s" not found in container.', $id),
            [$id]
        );
    }

    public function has(string $id): bool
    {
        if ($this->inner->has($id)) {
            return true;
        }

        return class_exists($id) && $this->isWithinAutowirableNamespace($id);
    }

    public function getTaggedServices(string $tag): array
    {
        return $this->inner->getTaggedServices($tag);
    }

    public function getInner(): Container
    {
        return $this->inner;
    }

    /**
     * @param class-string $className
     * @throws ReflectionException
     */
    private function make(string $className, bool $allowUnregistered): object
    {
        if ($allowUnregistered && !$this->isWithinAutowirableNamespace($className)) {
            throw new ContainerLogicException(
                sprintf(
                    'Class "%s" is not within an autowirable namespace prefix.',
                    $className
                )
            );
        }

        $reflectionClass = new ReflectionClass($className);
        $constructor = $reflectionClass->getConstructor();

        if ($constructor === null) {
            return $reflectionClass->newInstance();
        }

        $resolvedArguments = [];

        foreach ($constructor->getParameters() as $parameter) {
            $parameterType = $parameter->getType();

            if ($parameterType === null) {
                throw new ContainerLogicException(
                    sprintf(
                        'Unable to autowire service "%s": constructor parameter "$%s" has no type.',
                        $className,
                        $parameter->getName()
                    )
                );
            }

            if ($parameterType instanceof ReflectionUnionType) {
                throw new ContainerLogicException(
                    sprintf(
                        'Unable to autowire service "%s": union types are not supported for parameter "$%s".',
                        $className,
                        $parameter->getName()
                    )
                );
            }

            /** @var ReflectionNamedType $parameterType */
            if ($parameterType->isBuiltin()) {
                if ($parameterType->allowsNull()) {
                    $resolvedArguments[] = null;
                    continue;
                }

                throw new ContainerLogicException(
                    sprintf(
                        'Unable to autowire service "%s": unsupported builtin parameter "$%s".',
                        $className,
                        $parameter->getName()
                    )
                );
            }

            $argumentType = $parameterType->getName();

            if ($argumentType === ContainerInterface::class
                || $argumentType === Container::class
                || $argumentType === self::class
            ) {
                $resolvedArguments[] = $this;
                continue;
            }

            $resolved = false;

            foreach ($this->injectionExtensions as $extension) {
                if ($extension->supportsConstructorInjectionFor(
                    class: $className,
                    argumentName: $parameter->getName(),
                    argumentType: $argumentType,
                    argumentAttributes: $parameter->getAttributes(),
                )) {
                    $resolvedArguments[] = $extension->injectConstructorArgument(
                        class: $className,
                        argumentName: $parameter->getName(),
                        argumentType: $argumentType,
                        argumentAttributes: $parameter->getAttributes(),
                    );
                    $resolved = true;
                    break;
                }
            }

            if ($resolved) {
                continue;
            }

            try {
                $this->resolvingChain[] = $className;
                $resolvedArguments[] = $this->get($argumentType);
            } catch (ServiceNotFoundException $e) {
                if ($parameterType->allowsNull()) {
                    $resolvedArguments[] = null;
                    continue;
                }

                throw new ContainerLogicException(
                    sprintf(
                        'Unable to autowire service "%s" (Resolving chain: %s -> %s)',
                        $className,
                        implode(' -> ', $this->resolvingChain),
                        $argumentType
                    )
                );
            } finally {
                array_pop($this->resolvingChain);
            }
        }

        return $reflectionClass->newInstanceArgs($resolvedArguments);
    }

    private function isWithinAutowirableNamespace(string $className): bool
    {
        if ($this->autowirableNamespacePrefixes === []) {
            return false;
        }

        foreach ($this->autowirableNamespacePrefixes as $prefix) {
            $normalizedPrefix = str_ends_with($prefix, '\\') ? $prefix : $prefix . '\\';

            if ($className === rtrim($prefix, '\\') || str_starts_with($className, $normalizedPrefix)) {
                return true;
            }
        }

        return false;
    }
}

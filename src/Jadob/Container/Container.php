<?php

declare(strict_types=1);

namespace Jadob\Container;

use Jadob\Container\Exception\ContainerLockedException;
use function array_keys;
use function call_user_func_array;
use function class_exists;
use Closure;
use function in_array;
use Jadob\Container\Exception\AutowiringException;
use Jadob\Container\Exception\ContainerException;
use Jadob\Container\Exception\ServiceNotFoundException;
use Psr\Container\ContainerInterface;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use ReflectionNamedType;
use ReflectionParameter;
use RuntimeException;
use function is_object;
use function sprintf;

/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class Container implements ContainerInterface
{

    private const MAX_DEFINITION_WRAPS = 10;

    /**
     * @var array<string|class-string, Definition>
     */
    protected array $definitions = [];

    /**
     * Instantiated objects, ready to be used.
     *
     * @var array<string, object>
     */
    protected array $services = [];

    /**
     * If true, adding new services/aliases will throw an exception.
     *
     * @var bool
     */
    protected bool $locked = false;

    /**
     * @var array<string, string|int|float|array?
     */
    protected array $parameters = [];


    public function __construct(array $definitions = [])
    {
        foreach ($definitions as $serviceId => $definition) {
            if (($definition instanceof Definition) === false) {
                $definitions[$serviceId] = new Definition($definition);
            }
        }

        $this->definitions = $definitions;
    }

    /**
     * @param string $serviceName
     * @return mixed
     * @throws ServiceNotFoundException
     * @throws ContainerException
     */
    public function get(string $serviceName): object
    {
        /**
         * Return service if exists
         */
        if (isset($this->services[$serviceName])) {
            return $this->services[$serviceName];
        }

        if (isset($this->definitions[$serviceName])) {
            return $this->createServiceFromDefinition($serviceName);
        }

        /**
         * if reached this moment, the only thing we need to do, is to break
         */
        throw new ServiceNotFoundException(
            sprintf(
                'Service "%s" is not found in container.',
                $serviceName
            )
        );
    }

    /**
     * @throws ContainerException
     */
    private function unwrapDefinition(Definition $definition, int $wrapsCount = 0): string|object
    {

        if ($wrapsCount >= self::MAX_DEFINITION_WRAPS) {
            throw new ContainerException('Could not unwrap a definition as is it wrapped too much.');
        }

        $service = $definition->getService();
        if ($service instanceof Definition) {
            $service = $this->unwrapDefinition($definition, ++$wrapsCount);
        }

        return $service;
    }

    /**
     * @throws ContainerException
     */
    private function createServiceFromDefinition(string $serviceId): object
    {
        /**
         * Do not instantiate if exists
         */
        if (isset($this->services[$serviceId])) {
            return $this->services[$serviceId];
        }

        // Pick a present from under the tree
        $definition = $this->definitions[$serviceId];

        // unwrap them
        $service = $this->unwrapDefinition($definition);

        // put some batteries to our gift, if needed
        if ($service instanceof Closure) {
            $service = $this->instantiateFactory($service);
        }

        // make sure our present is running fine
        if (is_object($service) === false) {
            $service = $this->autowire($service);
        }

        // our toy can be better if we put some new parts:
        foreach ($definition->getMethodCalls() as $methodCall) {
            call_user_func_array(
                [
                    $service,
                    $methodCall->getMethodName()
                ],
                $methodCall->getArguments()
            );
        }

        // thank u santa, this is the best gift ever!
        $this->services[$serviceId] = $service;

        return $service;

    }


    /**
     * Turns a factory into service.
     * @param Closure $factory
     * @return mixed
     * @throws ContainerException
     */
    protected function instantiateFactory(Closure $factory): object
    {
        $service = $factory($this);

        if (!is_object($service)) {
            throw new ContainerException(sprintf(
                'Factory should return an object, %s returned',
                gettype($service)
            ));
        }

        return $service;
    }

    /**
     * @param string $factoryName
     * @param string $interfaceToCheck
     * @return bool|null
     * @throws ReflectionException
     */
    protected function factoryReturnImplements(Closure $factory, string $interfaceToCheck): ?bool
    {
        $reflectionMethod = new ReflectionMethod($factory, '__invoke');

        /**
         * There is no return type defined in factory, return null as at this moment is not possible to resolve
         * return type without service instantiating
         */
        if (!$reflectionMethod->hasReturnType()) {
            return null;
        }

        /** @var ReflectionNamedType $returnRypeReflection */
        $returnRypeReflection = $reflectionMethod->getReturnType();
        $returnType = $returnRypeReflection->getName();

        return $returnType === $interfaceToCheck
            || in_array($interfaceToCheck, class_implements($returnType), true)
            || in_array($interfaceToCheck, class_parents($returnType), true);
    }

    /**
     * @param string $interfaceClassName FQCN of interface that need to be verified
     *
     * @return array
     * @throws ReflectionException
     * @throws ContainerException
     */
    public function getObjectsImplementing(string $interfaceClassName): array
    {
        $objects = [];

        foreach ($this->services as $service) {
            if ($service instanceof $interfaceClassName) {
                $objects[] = $service;
            }
        }

        foreach ($this->definitions as $definition) {

            $unwrappedDefinition = $this->unwrapDefinition($definition);

            if ($unwrappedDefinition instanceof Closure) {
                /**
                 * When given factory has got a return type defined, use it and check that returned class implements
                 * requested interface
                 *
                 * Also, factoryReturnImplements() returns bool|null, so explicitly check for return type
                 */
                if ($this->factoryReturnImplements($unwrappedDefinition, $interfaceClassName) === false) {
                    continue;
                }

                /**
                 * If given factory does not have return type defined, instantiate them
                 */
                $service = $this->instantiateFactory($unwrappedDefinition);

                if ($service instanceof $interfaceClassName) {
                    $objects[] = $service;
                }
            } else {
                if ($unwrappedDefinition instanceof $interfaceClassName) {
                    // @TODO: we might autowire a service here, i guess
                    $objects[] = $unwrappedDefinition;
                }
            }
        }

        return $objects;
    }

    /**
     * A has() on steroids.
     * Checks the services and factories by it's type, not the name.
     *
     * @param string $className FQCN of class that we need to find
     * @return null|object - null when no object found
     * @throws ReflectionException
     * @throws ContainerException
     */
    public function findObjectByClassName(string $className)
    {
        if (in_array($className, [ContainerInterface::class, self::class], true)) {
            return $this;
        }

        //search in instantiated stuff
        foreach ($this->services as $service) {
            if ($service instanceof $className) {
                return $service;
            }
        }

        /**
         * Probably there is an issue:
         * When factory will request yet another service, it will be created and removed from $this->factories,
         * BUT these ones are still present in current foreach
         */
        foreach ($this->definitions as $definition) {
            $unwrapped = $this->unwrapDefinition($definition);

            if ($unwrapped instanceof Closure) {
                /**
                 * Use factory return check as this method works similar to getObjectsImplementing()
                 * @see self::getObjectsImplementing()
                 */
                if ($this->factoryReturnImplements($unwrapped, $className) === false) {
                    continue;
                }

                $service = $this->instantiateFactory($unwrapped);

                if ($service instanceof $className) {
                    return $service;
                }
            } elseif(get_class($service) === $className) {
                return $service;
            }
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function has($id): bool
    {
        return isset($this->services[$id]) || isset($this->factories[$id]);
    }

    /**
     * @param string $id
     * @param $object
     *
     * @return Definition
     * @throws ContainerLockedException
     */
    public function add(string $id, string|object $object)
    {
        if ($this->locked) {
            throw new ContainerLockedException('Could not add any services as container is locked.');
        }

        $definition = new Definition($object);
        $this->definitions[$id] = $definition;

        return $definition;
    }

    /**
     * @param string $from
     * @param string $to
     * @return Container
     * @throws ContainerException
     */
    public function alias(string $from, string $to): Container
    {
        //factories will create different stuff each time so we need to instantiate them
        if (isset($this->definitions[$from])) {
            $this->createServiceFromDefinition($from);
        }

        if (isset($this->services[$from])) {
            $this->services[$to] = &$this->services[$from];
        }

        return $this;
    }

    /**
     * @param string $key
     * @param string|int|float|array $value
     * @return void
     */
    public function addParameter(string $key, string|int|float|array $value): void
    {
        $this->parameters[$key] = $value;
    }

    /**
     * @param string $key
     * @return string|int|float|array
     */
    public function getParameter(string $key): string|int|float|array
    {
        if (!isset($this->parameters[$key])) {
            throw new RuntimeException('Could not find "' . $key . '" parameter');
        }

        return $this->parameters[$key];
    }

    /**
     * Creates new instance of object with dependencies that currently have been stored in container
     * @TODO REFACTOR - method looks ugly af
     * @param string $className
     * @return object
     * @throws AutowiringException
     * @throws ReflectionException
     */
    public function autowire(string $className): object
    {
        if (!class_exists($className)) {
            throw new AutowiringException(
                sprintf(
                    'Unable to autowire class "%s", as it does not exists.',
                    $className
                )
            );
        }

        $classReflection = new ReflectionClass($className);
        $constructor = $classReflection->getConstructor();

        //no dependencies required, we can just instantiate them and return
        if ($constructor === null) {
            $object = new $className();
            $this->services[$className] = $object;
            return $object;
        }


        $arguments = $constructor->getParameters();
        $argumentsToInject = [];

        #TODO REFACTOR - method looks ugly af
        foreach ($arguments as $argument) {
            $this->checkConstructorArgumentCanBeAutowired($argument, $className);

            $argumentClass = $argument->getType()->getName();
            try {
                $argumentsToInject[] = $this->findObjectByClassName($argumentClass);
            } catch (ServiceNotFoundException $exception) {
                //try to autowire if not found
                try {
                    $argumentsToInject[] = $this->autowire($argumentClass);
                } catch (ContainerException $autowiringException) {
                    //@TODO sprintf
                    throw new AutowiringException('Unable to autowire class "' . $className . '", could not find service ' . $argumentClass . ' in container. See Previous exception for details ', 0, $exception);
                }
            }
        }

        $service = new $className(...$argumentsToInject);
        $this->services[$className] = $service;
        return $service;
    }

    /**
     * @param ReflectionParameter $parameter
     * @param string $className
     * @throws AutowiringException
     */
    protected function checkConstructorArgumentCanBeAutowired(ReflectionParameter $parameter, string $className)
    {
        //no nulls allowed
        if ($parameter->getType() === null) {
            //@TODO use sprintf
            throw new AutowiringException('Unable to autowire class "' . $className . '", one of arguments is null.');
        }

        //only classes allowed so far
        if ($parameter->getType()->isBuiltin()) {
            //@TODO use sprintf
            throw new AutowiringException('Unable to autowire class "' . $className . '", as "$' . $parameter->name . '" constructor argument requires a scalar value');
        }
    }

    /**
     * Prevents adding new services to container.
     * @return void
     */
    public function lock(): void
    {
        $this->locked = true;
    }
}
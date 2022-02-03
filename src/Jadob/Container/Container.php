<?php

declare(strict_types=1);

namespace Jadob\Container;

use function array_keys;
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

/**
 * @TODO:   maybe some arrayaccess? Fixed services?
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class Container implements ContainerInterface
{

    /**
     * @var array<string, object>
     */
    protected array $definitions = [];

    /**
     * Instantiated objects, ready to be used.
     *
     * @var array<string, object>
     */
    protected array $services = [];

    /**
     * Closures, arrays, components that can be used to instantiate a new service.
     *
     * @var array<string, object>
     */
    protected array $factories = [];

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

    /**
     * Container constructor.
     *
     * @param array|null $services
     * @param array|null $factories
     */
    public function __construct(array $services = null, array $factories = null)
    {
        if ($services !== null) {
            $this->services = $services;
        }

        if ($factories !== null) {
            $this->factories = $factories;
        }
    }

    /**
     * This methods does not try to autowire services.
     *
     * @param string $serviceName
     * @return mixed
     * @throws ServiceNotFoundException
     * @throws ContainerException
     */
    public function get($serviceName)
    {

        /**
         * Check there is a factory for given service
         */
        if (isset($this->factories[$serviceName])) {
            /**
             * instantiateFactory() adds them to $this->services, so we can just return them here
             */
            return $this->instantiateFactory($serviceName);
        }

        /**
         * Return service if exists
         */
        if (isset($this->services[$serviceName])) {
            return $this->services[$serviceName];
        }

        /**
         * if reached this moment, the only thing we need to do, is to break
         */
        throw new ServiceNotFoundException('Service ' . $serviceName . ' is not found in container.');
    }

    /**
     * Turns a factory into service.
     *
     * @param string $factoryName
     * @return mixed
     */
    protected function instantiateFactory(string $factoryName)
    {
        /**
         * Do not instantiate factories if it has been instantiated
         */
        if (isset($this->services[$factoryName])) {
            return $this->services[$factoryName];
        }


        $service = $this->factories[$factoryName]($this);

        if (!is_object($service)) {
            throw new ContainerException('Factory "' . $factoryName . '" should return an object, ' . gettype($service) . ' returned');
        }

        $this->services[$factoryName] = $service;
        unset($this->factories[$factoryName]);
        return $this->services[$factoryName];
    }

    /**
     * @param string $factoryName
     * @param string $interfaceToCheck
     * @return bool|null
     * @throws ReflectionException
     */
    protected function factoryReturnImplements(string $factoryName, string $interfaceToCheck): ?bool
    {
        if (!isset($this->factories[$factoryName])) {
            return null;
        }

        $factory = $this->factories[$factoryName];
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

        return (bool) (
            $returnType === $interfaceToCheck
            || in_array($interfaceToCheck, class_implements($returnType), true)
            || in_array($interfaceToCheck, class_parents($returnType), true)
        ) 
             
        

         ;
    }

    /**
     * @param string $interfaceClassName FQCN of interface that need to be verified
     *
     * @return array
     * @throws ReflectionException
     */
    public function getObjectsImplementing(string $interfaceClassName): array
    {
        $objects = [];

        foreach ($this->services as $service) {
            if ($service instanceof $interfaceClassName) {
                $objects[] = $service;
            }
        }

        foreach (array_keys($this->factories) as $factoryName) {
            /**
             * When given factory has got a return type defined, use it and check that returned class implements
             * requested interface
             *
             * Also, factoryReturnImplements() returns bool|null, so explicitly check for return type
             */
            if ($this->factoryReturnImplements($factoryName, $interfaceClassName) === false) {
                continue;
            }

            /**
             * If given factory does not have return type defined, instantiate them
             */
            $service = $this->instantiateFactory($factoryName);

            if ($service instanceof $interfaceClassName) {
                $objects[] = $service;
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
        foreach (array_keys($this->factories) as $factoryName) {

            /**
             * Use factory return check as this method works similar to getObjectsImplementing()
             * @see self::getObjectsImplementing()
             */
            if ($this->factoryReturnImplements($factoryName, $className) === false) {
                continue;
            }

            $service = $this->instantiateFactory($factoryName);

            if ($service instanceof $className) {
                return $service;
            }
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function has($id)
    {
        return isset($this->services[$id]) || isset($this->factories[$id]);
    }

    /**
     * @param string $id
     * @param $object
     *
     * @return Definition
     */
    public function add(string $id, object $object)
    {
        $definition = new Definition($object);
        $this->definitions[$id] = $definition;

        if ($object instanceof Closure) {
            $this->factories[$id] = $object;
        } else {
            $this->services[$id] = $object;
        }

        return $definition;
    }

    /**
     * @param string $from
     * @param string $to
     * @return Container
     */
    public function alias(string $from, string $to): Container
    {

        //factories will create different stuff each time so we need to instantiate them
        if (isset($this->factories[$from])) {
            $this->instantiateFactory($from);
        }

        if (isset($this->services[$from])) {
            $this->services[$to] = &$this->services[$from];
        }

        return $this;
    }

    /**
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
            throw new AutowiringException('Unable to autowire class "' . $className . '", as it does not exists.');
        }

        $classReflection = new ReflectionClass($className);
        $constructor = $classReflection->getConstructor();

        //no dependencies required, we can just instantiate them and return
        if ($constructor === null) {
            $object = new $className();
            $this->add($className, $object);
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
                    //TODO Named constructors
                    throw new AutowiringException('Unable to autowire class "' . $className . '", could not find service ' . $argumentClass . ' in container. See Previous exception for details ', 0, $exception);
                }
            }
        }

        $service = new $className(...$argumentsToInject);
        $this->add($className, $service);
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
            //TODO Named constructors
            throw new AutowiringException('Unable to autowire class "' . $className . '", one of arguments is null.');
        }

        //only classes allowed so far
        if ($parameter->getType()->isBuiltin()) {
            //TODO Named constructors
            throw new AutowiringException('Unable to autowire class "' . $className . '", as "$' . $parameter->name . '" constructor argument requires a scalar value');
        }
    }
}
<?php

declare(strict_types=1);

namespace Jadob\Container;

use Closure;
use Jadob\Container\Exception\ServiceNotFoundException;
use Psr\Container\ContainerInterface;
use RuntimeException;
use function array_keys;
use function in_array;

/**
 * @TODO: maybe some arrayaccess? Fixed services?
 * @package Jadob\Container
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class Container implements ContainerInterface
{

    /**
     * @var Definition[]
     */
    protected $definitions = [];

    /**
     * Instantiated objects, ready to be used.
     * @var array
     */
    protected $services = [];

    /**
     * Closures, arrays, components that can be used to instantiate a new service.
     * @var array
     */
    protected $factories = [];

    /**
     * If true, adding new services/aliases will throw an exception.
     * @var bool
     */
    protected $locked = false;

    /**
     * @var array
     */
    protected $parameters;

    /**
     * Container constructor.
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
     * @param string $serviceName
     * @return mixed
     * @throws ServiceNotFoundException
     */
    public function get($serviceName)
    {

        if (isset($this->factories[$serviceName])) {
            return $this->instantiateFactory($serviceName);
        }

        if (isset($this->services[$serviceName])) {
            return $this->services[$serviceName];
        }

        throw new ServiceNotFoundException('Service ' . $serviceName . ' is not found in container.');

    }

    /**
     * @param string $factoryName
     * @return mixed
     */
    protected function instantiateFactory(string $factoryName)
    {
        //@TODO find why DoctrineDBALBridge breaks here
        if (isset($this->services[$factoryName])) {
            return $this->services[$factoryName];
        }

        $this->services[$factoryName] = $this->factories[$factoryName]($this);
        unset($this->factories[$factoryName]);
        return $this->services[$factoryName];
    }

    /**
     * UNSTABLE, there will be some work needed
     * @param string $interfaceClassName FQCN of interface that need to be verified
     * @return null|object[]
     */
    public function getObjectsImplementing(string $interfaceClassName): ?array
    {
        $objects = [];

        foreach ($this->services as $service) {
            if ($service instanceof $interfaceClassName) {
                $objects[] = $service;
            }
        }

        foreach (array_keys($this->factories) as $factoryName) {
            $service = $this->instantiateFactory($factoryName);

            if ($service instanceof $interfaceClassName) {
                $objects[] = $service;
            }
        }

        if (count($objects) === 0) {
            return null;
        }

        return $objects;
    }

    /**
     * @param string $className FQCN of class that we need to find
     * @return mixed
     * @throws ServiceNotFoundException
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
            $service = $this->instantiateFactory($factoryName);

            if ($service instanceof $className) {
                return $service;
            }
        }

        throw new ServiceNotFoundException('There is no service extending/implementing ' . $className . ' class.');
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
     * @return Definition
     */
    public function add(string $id, $object)
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
     * @param string $key
     * @param $value
     */
    public function addParameter(string $key, $value)
    {
        $this->parameters[$key] = $value;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function getParameter(string $key)
    {
        if (!isset($this->parameters[$key])) {
            throw new RuntimeException('Could not find "' . $key . '" parameter');
        }

        return $this->parameters[$key];
    }
}
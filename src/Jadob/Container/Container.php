<?php

namespace Jadob\Container;

use Jadob\Container\Exception\ServiceNotFoundException;

use Psr\Container\ContainerInterface;

/**
 * Class Container
 * @TODO: maybe some arrayaccess?
 * @package Jadob\Container
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class Container implements ContainerInterface
{

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
     * UNSTABLE, there will be some tests needed
     * @param string $interfaceClassName FQCN of interface that need to be verified
     * @return null|object[]
     */
    public function getObjectsImplementing($interfaceClassName)
    {
        $objects = [];

        foreach ($this->services as $service) {
            if ($service instanceof $interfaceClassName) {
                $objects[] = $service;
            }
        }

        foreach (\array_keys($this->factories) as $factoryName) {
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
     */
    public function findObjectByClassName($className)
    {

        if (\in_array($className, [ContainerInterface::class, self::class])) {
            return $this;
        }

        //search in instantiated stuff
        foreach ($this->services as $service) {
            if ($service instanceof $className) {
                return $service;
            }
        }

        foreach (\array_keys($this->factories) as $factoryName) {
            $service = $this->instantiateFactory($factoryName);

            if ($service instanceof $className) {
                return $service;
            }
        }

        throw new ServiceNotFoundException('There is no service extendind/implementing ' . $className . ' class.');
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
     * @return $this
     */
    public function add($id, $object)
    {

        if ($object instanceof \Closure) {
            $this->factories[$id] = $object;
        } else {
            $this->services[$id] = $object;
        }

        return $this;
    }

    /**
     * @param string $factoryName
     * @return mixed
     */
    protected function instantiateFactory($factoryName)
    {
        $this->services[$factoryName] = $this->factories[$factoryName]($this);
        unset($this->factories[$factoryName]);
        return $this->services[$factoryName];
    }


    /**
     * @param string $from
     * @param string $to
     * @return Container
     */
    public function alias(string $from, string $to)
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
}
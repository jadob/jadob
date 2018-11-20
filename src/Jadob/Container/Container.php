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
            $service = $this->factories[$serviceName]($this);

            unset($this->factories[$serviceName]);
            $this->services[$serviceName] = $service;
        }

        if (isset($this->services[$serviceName])) {
            return $this->services[$serviceName];
        }

        throw new ServiceNotFoundException('Service ' . $serviceName . ' is not found in container.');

    }

    /**
     * @param string $interfaceClassName FQCN of interface that need to be verified
     * @return null|object[]
     */
    public function getObjectsImplementing($interfaceClassName)
    {
        $objects = [];


        if (count($objects) === 0) {
            return null;
        }

        return $objects;
    }

    /**
     * @param $className
     * @return mixed
     */
    public function findObjectByClassName($className)
    {
        foreach ($this->services as $service) {
            if ($service instanceof $className) {
                return $service;
            }
        }

        throw new ServiceNotFoundException('There is no service extendind/implementing '.$className.' class.');
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
        $this->services[$id] = $object;
        return $this;
    }

}
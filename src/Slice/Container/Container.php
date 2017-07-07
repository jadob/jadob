<?php

namespace Slice\Container;

use Slice\Container\Exception\ContainerException;
use Slice\Container\ServiceProvider\ServiceProviderInterface;

/**
 * Class Container
 * @package Slice\Container
 */
class Container
{

    /**
     * @var array
     */
    protected $container;

    /**
     * @param string $name
     * @param mixed $object
     * @return $this
     */
    public function add($name, $object)
    {
        $this->container[trim($name)] = $object;

        return $this;
    }

    /**
     * @param string $providerClass FQCN of service provider
     * @param array $configuration framework configuration
     * @return $this
     * @throws \Slice\Container\Exception\ContainerException
     */
    public function registerProvider($providerClass, array $configuration = [])
    {
        if(!in_array(ServiceProviderInterface::class, class_implements($providerClass), true)) {
            throw new ContainerException(
                'Class '.$providerClass.' should implement '.ServiceProviderInterface::class.'.');
        }

        /** @var ServiceProviderInterface $provider */
        $provider = new $providerClass;
        $provider->register($this, $configuration);

        return $this;
    }

    /**
     * @param string $name service name
     * @return mixed
     * @throws ContainerException
     */
    public function get($name)
    {
        $name = trim($name);

        if(isset($this->container[$name])) {
            return $this->container[$name];
        }

        throw new ContainerException('Service "'.$name.'" is not defined.');
    }

    /**
     * @param $name
     * @return bool
     */
    public function has($name): bool
    {
        return isset($this->container[trim($name)]);
    }
}
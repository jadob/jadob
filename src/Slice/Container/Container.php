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
     * @param ServiceProviderInterface $providerClass
     * @param array $configuration
     * @return $this
     */
    public function registerProvider(ServiceProviderInterface $providerClass, array $configuration = [])
    {
        /**
         * @TODO: implement registerProvider function
         */
        return $this;
    }

    /**
     * @param string $name
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
<?php
namespace Slice\Container;
use Slice\Container\Exception\ContainerException;

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

    public function add($prefix, $object)
    {

        $this->container[trim($prefix)] = $object;

        return $this;
    }

    public function registerProvider($providerClass, array $params = [])
    {

        return $this;
    }

    public function get($name)
    {
        if(isset($this->container[$name])) {
            return $this->container[$name];
        }

        throw new ContainerException('Service '.$name.' is not defined.');
    }

}
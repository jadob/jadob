<?php

namespace Slice\Container;
use Slice\Container\Exception\ContainerException;


/**
 * Class Container
 * @package Slice\Container
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class Container {

    /**
     * @var array
     */
    private $container = [];

    /**
     * Container constructor.
     */
    public function __construct() {
        
    }

    /**
     * @param $key
     * @param $object
     * @return $this
     */
    public function add($key, $object) {
        $this->container[$key] = $object;

        return $this;
    }

    /**
     * @param $key
     * @return mixed
     * @throws ContainerException
     */
    public function get($key) {
        if (isset($this->container[$key])) {
            return $this->container[$key];
        }
        
        throw new ContainerException('Service "'.$key.'" is not registered.');
    }

}

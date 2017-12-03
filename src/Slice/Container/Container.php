<?php

namespace Slice\Container;

use Psr\Container\ContainerInterface;
use Slice\Container\Exception\ServiceNotFoundException;

/**
 * Class Container
 * @package Slice\Container
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 * @see http://www.php-fig.org/psr/psr-11/
 */
class Container implements ContainerInterface
{

    /**
     * @var array
     */
    private $container = [];

    /**
     * Container constructor.
     */
    public function __construct()
    {

    }

    /**
     * @param $id
     * @param $object
     * @return $this
     * @internal param $key
     */
    public function add($id, $object)
    {
        $this->container[$id] = $object;

        return $this;
    }

    /**
     * @inheritdoc
     */
    public function get($id)
    {
        if (isset($this->container[$id])) {
            return $this->container[$id];
        }

        throw new ServiceNotFoundException('Service "' . $id . '" is not registered.');
    }

    /**
     * @inheritdoc
     */
    public function has($id)
    {
        return isset($this->container[$id]);
    }
}

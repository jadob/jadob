<?php

namespace Slice\Router;

use Iterator;

/**
 * Class RouteCollection
 * @package Slice\Router
 */
class RouteCollection implements Iterator
{
    /**
     * @var array
     */
    private $collection;

    /**
     * RouteCollection constructor.
     * @param array $routes
     */
    public function __construct(array $routes)
    {
        $this->collection = $routes;
    }

    public function rewind()
    {
        reset($this->collection);
    }

    public function current()
    {
        return current($this->collection);
    }

    public function key()
    {
        return key($this->collection);
    }

    public function next()
    {
        return next($this->collection);
    }

    public function valid(): bool
    {
        return false !== current($this->collection);
    }
}
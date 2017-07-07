<?php

namespace Slice\Router;

/**
 * Class RouteCollection
 * @package Slice\Router
 */
class RouteCollection
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

}
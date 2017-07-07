<?php

namespace Slice\Router;

/**
 * Class Router
 * @package Slice\Router
 */
class Router
{

    /**
     * @var RouteCollection
     */
    protected $routeCollection;

    /**
     * @param RouteCollection $routeCollection
     * @return Router
     */
    public function setRouteCollection(RouteCollection $routeCollection): Router
    {
        $this->routeCollection = $routeCollection;
        return $this;
    }

}
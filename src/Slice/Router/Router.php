<?php

namespace Slice\Router;

use Slice\Core\HTTP\Request;

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
     * @var Request
     */
    protected $request;

    /**
     * @param RouteCollection $routeCollection
     * @return Router
     */
    public function setRouteCollection(RouteCollection $routeCollection): Router
    {
        $this->routeCollection = $routeCollection;
        return $this;
    }

    /**
     * @return Request
     */
    public function getRequest(): Request
    {
        return $this->request;
    }

    /**
     * @param mixed $request
     * @return Router
     */
    public function setRequest(Request $request): Router
    {
        $this->request = $request;
        return $this;
    }


    public function matchRoute()
    {
        $outputRoute = new Route();


        foreach ($this->routeCollection as $key => $route) {
           $outputRoute->setRouteName($key);
        }


    }
}
<?php
/**
 * Created by PhpStorm.
 * User: mikolajczajkowsky
 * Date: 18.06.2017
 * Time: 00:42
 */

namespace Slice\Router;

/**
 * Class Router
 * @package Slice\Router
 */
class Router
{

    /**
     * @var array
     */
    protected $routes;

    /**
     * @return array
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }

    /**
     * @param array $routes
     * @return Router
     */
    public function setRoutes(array $routes): Router
    {
        $this->routes = $routes;
        return $this;
    }

}
<?php
/**
 * Created by PhpStorm.
 * User: mikolajczajkowsky
 * Date: 18.06.2017
 * Time: 00:42
 */

namespace Slice\Router;


/**
 * Class Route
 * @package Slice\Router
 */
class Route
{
    /**
     * @var string
     */
    private $routeName;

    /**
     * @var array
     */
    private $parameters;

    /**
     * @return string
     */
    public function getRouteName(): string
    {
        return $this->routeName;
    }

    /**
     * @param string $routeName
     * @return Route
     */
    public function setRouteName($routeName): Route
    {
        $this->routeName = $routeName;
        return $this;
    }

}
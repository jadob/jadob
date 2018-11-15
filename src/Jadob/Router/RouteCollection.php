<?php

namespace Jadob\Router;

/**
 * @package Jadob\Router
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class RouteCollection implements \ArrayAccess, \Iterator, \Countable
{
    /**
     * @var string|null
     */
    protected $host;

    /**
     * @var string|null
     */
    protected $prefix;

    /**
     * @var Route[]
     */
    protected $routes;

    /**
     * @param Route $route
     * @return $this
     */
    public function addRoute(Route $route)
    {

//        r($this->getHost());
        $route->setHost($this->getHost());
        $route->setPath($this->getPrefix() . $route->getPath());
        $this->routes[$route->getName()] = $route;
        return $this;
    }

    public function __construct($prefix = null, $host = null)
    {
        $this->prefix = $prefix;
        $this->host = $host;
    }

    /**
     * Merges passed $collection with current object.
     * @param RouteCollection $collection
     * @return RouteCollection
     */
    public function addCollection(RouteCollection $collection)
    {

//        r($collection);
        foreach ($collection as $route) {


//            r($route);
            $route->setPath($this->getPrefix() .  $route->getPath());


            $this->routes[$route->getName()] = $route;
        }

        return $this;

    }

    /**
     * {@inheritdoc}
     */
    public function offsetExists($offset)
    {
        return isset($this->routes[$offset]);
    }

    /**
     * {@inheritdoc}
     */
    public function offsetGet($offset)
    {
        return $this->routes[$offset];
    }

    /**
     * {@inheritdoc}
     */
    public function offsetSet($offset, $value)
    {
        $this->routes[$offset] = $value;
    }

    /**
     * {@inheritdoc}
     */
    public function offsetUnset($offset)
    {
        unset($this->routes[$offset]);
    }

    /**
     * @return Route
     */
    public function rewind(): Route
    {
        return \reset($this->routes);
    }

    /**
     * @return Route
     */
    public function current()
    {
        return current($this->routes);
    }

    /**
     * @return int|null|string
     */
    public function key()
    {
        return key($this->routes);
    }

    /**
     * @return Route
     */
    public function next()
    {
        return \next($this->routes);
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        return \key($this->routes) !== null;
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return \count($this->routes);
    }

    /**
     * @return null|string
     */
    public function getHost(): ?string
    {
        return $this->host;
    }

    /**
     * @param null|string $host
     * @return RouteCollection
     */
    public function setHost(?string $host): RouteCollection
    {
        $this->host = $host;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getPrefix(): ?string
    {
        return $this->prefix;
    }

    /**
     * @param null|string $prefix
     * @return RouteCollection
     */
    public function setPrefix(?string $prefix): RouteCollection
    {
        $this->prefix = $prefix;
        return $this;
    }

}
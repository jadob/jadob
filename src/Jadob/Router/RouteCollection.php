<?php

namespace Jadob\Router;

use Jadob\Router\Exception\RouterException;

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
    protected $routes = [];

    /**
     * @var RouteCollection
     */
    protected $parentCollection;

    /**
     * RouteCollection constructor.
     * @param string|null $prefix
     * @param string|null $host
     */
    public function __construct(?string $prefix = null, ?string $host = null)
    {
        $this->prefix = $prefix;
        $this->host = $host;
    }

    /**
     * @param Route $route
     * @return $this
     */
    public function addRoute(Route $route)
    {
        $route->setParentCollection($this);

        if($route->getHost() === null) {
            $route->setHost($this->getHost());
        }
        $this->routes[$route->getName()] = $route;
        return $this;
    }

    /**
     * Merges passed $collection with current object.
     * @param RouteCollection $collection
     * @return RouteCollection
     */
    public function addCollection(RouteCollection $collection): RouteCollection
    {
        $collection->setParentCollection($this);

        foreach ($collection as $route) {
            if($route->getHost() === null) {
                $route->setHost($this->getHost());
            }

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
     * {@inheritdoc}
     */
    public function rewind()
    {
        \reset($this->routes);
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
        if ($this->parentCollection !== null) {
            return $this->parentCollection->getPrefix() . $this->prefix;
        }

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

    /**
     * @return RouteCollection
     */
    public function getParentCollection(): ?RouteCollection
    {
        return $this->parentCollection;
    }

    /**
     * @param RouteCollection $parentCollection
     * @return RouteCollection
     */
    public function setParentCollection(RouteCollection $parentCollection): RouteCollection
    {
        $this->parentCollection = $parentCollection;
        return $this;
    }


    /**
     * @param array[] $data
     * @return RouteCollection
     * @throws Exception\RouterException
     */
    public static function fromArray(array $data)
    {
        $routeCollection = new self();

        foreach ($data as $routeName => $routeArray) {
            if(\is_integer($routeName) && \is_string($routeArray)) {
                throw new RouterException('Route "'.$routeArray.'" looks malformed. Please provide a valid array as a value for this route.');
            }

            if(!isset($routeArray['name'])) {
                $routeArray['name'] = $routeName;
            }

            $routeCollection->addRoute(Route::fromArray($routeArray));
        }

        return $routeCollection;
    }

}
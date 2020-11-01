<?php

namespace Jadob\Router;

use ArrayAccess;
use Countable;
use Iterator;
use Jadob\Router\Exception\RouterException;
use function count;
use function is_integer;
use function is_string;
use function key;
use function next;
use function reset;

/**
 * @package Jadob\Router
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class RouteCollection implements ArrayAccess, Iterator, Countable
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
     *
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

        if ($route->getHost() === null) {
            $route->setHost($this->getHost());
        }
        $this->routes[$route->getName()] = $route;
        return $this;
    }

    /**
     * Merges passed $collection with current object.
     * At this level there is no need to merge paths with prefixes, as Route#getPath() will ask his parentCollection
     * (if exists) for full prefix.
     *
     * @param RouteCollection $collection
     * @return RouteCollection
     */
    public function addCollection(RouteCollection $collection): RouteCollection
    {
        $collection->setParentCollection($this);

        foreach ($collection as $route) {
            if ($route->getHost() === null) {
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
        reset($this->routes);
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
        return next($this->routes);
    }

    /**
     * @return bool
     */
    public function valid(): bool
    {
        return key($this->routes) !== null;
    }

    /**
     * {@inheritdoc}
     */
    public function count()
    {
        return count($this->routes);
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
            /**
             * Prevents from passing invalid values to further processing.
             * @TODO drop it or refactor, as input typehints should handle this too
             */
            if (is_integer($routeName) && is_string($routeArray)) {
                throw new RouterException('Route or collection"' . $routeArray . '" looks malformed. Please provide a valid array as a value for this route.');
            }

            /**
             * Allows to add Route collections directly in array of routes.
             * Collections array MUST contain both prefix and routes keys, which single route SHOULD NOT have.
             * Also: $routeName in case of collections has symbolic meaning, this name would not be registered in router anyway.
             */
            if (isset($routeArray['prefix'], $routeArray['routes']) && is_array($routeArray['routes'])) {
                $nestedRouteCollection = RouteCollection::fromArray($routeArray['routes']);
                $nestedRouteCollection->setPrefix($routeArray['prefix']);

                /**
                 * In collections, only prefix is required.
                 */
                if(isset($routeArray['host'])) {
                    $nestedRouteCollection->setHost($routeArray['host']);
                }

                $routeCollection->addCollection($nestedRouteCollection);
            } else {
                if (!isset($routeArray['name'])) {
                    $routeArray['name'] = $routeName;

                }
                $routeCollection->addRoute(Route::fromArray($routeArray));
            }
        }

        return $routeCollection;
    }

}
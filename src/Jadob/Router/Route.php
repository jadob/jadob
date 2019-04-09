<?php

namespace Jadob\Router;

/**
 * Class Route
 * @package Jadob\Router
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class Route
{

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $path;

    /**
     * @var string
     */
    protected $action;

    /**
     * @var string|\Closure
     */
    protected $controller;

    /**
     * @var string|null
     */
    protected $host;

    /**
     * @var array
     */
    protected $params = [];

    /**
     * @var null|RouteCollection
     */
    protected $parentCollection;

    /**
     * @var string[]
     */
    protected $methods;

    /**
     * @param string $name
     * @param string|null $path
     * @param string|null $controller
     * @param string|null $action
     * @param string|null $host
     * @param int $methods
     */
    public function __construct($name, $path = null, $controller = null, $action = '__invoke', $host = null, $methods = [])
    {
        $this->name = $name;
        $this->path = $path;
        $this->controller = $controller;
        $this->action = $action;
        $this->host = $host;
        $this->methods = $methods;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Route
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        if ($this->parentCollection !== null) {
            return $this->parentCollection->getPrefix() . $this->path;
        }

        return $this->path;
    }

    /**
     * @param mixed $path
     * @return Route
     */
    public function setPath($path)
    {
        $this->path = $path;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param string|null $action
     * @return Route
     */
    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * @param mixed $controller
     * @return Route
     */
    public function setController($controller)
    {
        $this->controller = $controller;
        return $this;
    }

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param array $params
     * @return Route
     */
    public function setParams($params)
    {
        $this->params = $params;
        return $this;
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
     * @return Route
     */
    public function setHost($host): Route
    {
        $this->host = $host;
        return $this;
    }

    /**
     * @param string[] $methods
     * @return Route
     */
    public function setMethods(array $methods): Route
    {
        $this->methods = $methods;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getMethods(): array
    {
        return $this->methods;
    }

    /**
     * @return RouteCollection|null
     */
    public function getParentCollection(): ?RouteCollection
    {
        return $this->parentCollection;
    }

    /**
     * @param RouteCollection|null $parentCollection
     * @return Route
     */
    public function setParentCollection(?RouteCollection $parentCollection): Route
    {
        $this->parentCollection = $parentCollection;
        return $this;
    }

}

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
     * @var string
     */
    protected $controller;

    /**
     * @var bool
     */
    protected $ignoreGlobalPrefix = false;

    /**
     * @var string|null
     */
    protected $host;

    /**
     * @var array
     */
    protected $params = [];

    /**
     * @param string $name
     * @param string|null $path
     * @param string|null $controller
     * @param string|null $action
     * @param string|null $host
     * @param bool $ignoreGlobalPrefix
     */
    public function __construct($name, $path = null, $controller = null, $action = '__invoke', $host = null, $ignoreGlobalPrefix = false)
    {
        $this->name = $name;
        $this->path = $path;
        $this->controller = $controller;
        $this->action = $action;
        $this->ignoreGlobalPrefix = $ignoreGlobalPrefix;
        $this->host = $host;
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
     * @return bool
     */
    public function isIgnoreGlobalPrefix(): bool
    {
        return $this->ignoreGlobalPrefix;
    }

    /**
     * @param bool $ignoreGlobalPrefix
     * @return Route
     */
    public function setIgnoreGlobalPrefix(bool $ignoreGlobalPrefix): Route
    {
        $this->ignoreGlobalPrefix = $ignoreGlobalPrefix;
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
    public function setHost(?string $host): Route
    {
        $this->host = $host;
        return $this;
    }

}

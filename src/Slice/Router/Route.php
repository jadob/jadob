<?php

namespace Slice\Router;

/**
 * Class Route
 * @package Slice\Router
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class Route
{

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $action;

    /**
     * @var string
     */
    private $controller;

    /**
     * @var bool
     */
    private $ignoreLocalePrefix = false;

    /**
     * @var array
     */
    private $params = [];

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
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
     * @param mixed $action
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
    public function isIgnoreLocalePrefix(): bool
    {
        return $this->ignoreLocalePrefix;
    }

    /**
     * @param bool $ignoreLocalePrefix
     * @return Route
     */
    public function setIgnoreLocalePrefix(bool $ignoreLocalePrefix): Route
    {
        $this->ignoreLocalePrefix = $ignoreLocalePrefix;
        return $this;
    }

}

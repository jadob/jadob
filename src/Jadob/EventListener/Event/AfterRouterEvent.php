<?php

namespace Jadob\EventListener\Event;

use Jadob\Router\Route;
use Jadob\Router\Router;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class AfterRouterEvent
 * @package Jadob\EventListener\Event
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class AfterRouterEvent implements EventParameterInterface
{
    /**
     * @var Route
     */
    protected $route;

    /**
     * @var null|Response
     */
    protected $response;

    /**
     * AfterRouterEvent constructor.
     * @param Route $route
     * @param null $response
     */
    public function __construct(Route $route, $response = null)
    {
        $this->route = $route;
        $this->response = $response;
    }

    /**
     * @return Route
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * @param mixed $route
     * @return AfterRouterEvent
     */
    public function setRoute($route)
    {
        $this->route = $route;
        return $this;
    }

    /**
     * @return null|Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param Response $response
     * @return AfterRouterEvent
     */
    public function setResponse(Response $response)
    {
        $this->response = $response;
        return $this;
    }

}
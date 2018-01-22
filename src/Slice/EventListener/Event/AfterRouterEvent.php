<?php

namespace Slice\EventListener\Event;

use Slice\Router\Route;
use Symfony\Component\HttpFoundation\Response;

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

    public function __construct(Route $route, $response = null)
    {
        $this->route = $route;
        $this->response = $response;
    }

    /**
     * @return mixed
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
<?php

namespace Jadob\Core;

use Jadob\Container\Container;
use Jadob\Router\Router;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class Dispatcher
 * @package Jadob\Core
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class Dispatcher
{

    /**
     * @var Container
     */
    protected $container;

    /**
     * Dispatcher constructor.
     * @param Container $container
     */
    public function __construct(Container $container)
    {
       $this->container = $container;
    }

    /**
     * @param Request $request
     * @return Response
     * @throws \InvalidArgumentException
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
     */
    public function executeRequest(Request $request)
    {
        /** @var Router $router */
        $router = $this->container->get('router');

        $route = $router->matchRequest($request);


        return new Response();
    }
}
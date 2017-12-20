<?php

namespace Slice\Core;

use ReflectionMethod;
use Slice\Container\Container;
use Slice\Core\Exception\DispatcherException;
use Slice\MVC\Controller\AbstractController;
use Slice\Router\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Zend\Config\Config;

/**
 * Class Dispatcher
 * @package Slice\Core
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class Dispatcher
{

    /**
     * @var string
     */
    private $env;

    /**
     * @var Config
     */
    private $config;

    /**
     * @var Container
     */
    private $container;

    /**
     * Dispatcher constructor.
     * @param string $env
     * @param Config $config
     * @param Container $container
     */
    public function __construct($env, \Zend\Config\Config $config, Container $container)
    {
        $this->env = $env;
        $this->config = $config;
        $this->container = $container;
    }

    /**
     * @param Request $request
     * @return Response
     * @throws \ReflectionException
     * @throws \Slice\Container\Exception\ContainerException
     * @throws DispatcherException
     * @throws \Slice\Container\Exception\ServiceNotFoundException
     */
    public function execute(Request $request)
    {

        $this->container->get('event.dispatcher')->dispatchEvent('event.before.router');

        /** @var Route $route */
        $route = $this->container->get('router')->matchRoute($request);

        $this->container->get('event.dispatcher')->dispatchEvent('event.after.router');


        $controllerClassName = $route->getController();

        if (!class_exists($controllerClassName)) {
            throw new DispatcherException('Class "' . $controllerClassName . '" '
                . 'does not exists or it cannot be used as a controller.');
        }

        $this->container->get('event.dispatcher')->dispatchEvent('event.before.controller');

        /** @var AbstractController $controller */
        $controller = new $controllerClassName($this->container);
        $action = $route->getAction() . 'Action';

        if (!method_exists($controller, $action)) {
            throw new DispatcherException('Action "' . $action . '" does not exists in ' . get_class($controller));
        }

        $params = $this->getOrderedParamsForAction($controller, $action, $route);

        /** @var Response $response */
        $response = call_user_func_array([$controller, $action], $params);

        $afterControllerListener = $this->container->get('event.dispatcher')->dispatchEvent('event.after.controller');

        if ($afterControllerListener !== null) {
            $response = $afterControllerListener;
        }

        //TODO: Response validation
//        if (!in_array(Response::class, class_parents($response), true)) {
//            throw new DispatcherException('Invalid response type');
//        }

        return $response;

    }

    /**
     * @param $controller
     * @param $action
     * @param Route $route
     * @return array
     * @throws \ReflectionException
     */
    private function getOrderedParamsForAction($controller, $action, Route $route)
    {
        $reflection = new ReflectionMethod($controller, $action);

        $params = $route->getParams();

        $output = [];
        foreach ($reflection->getParameters() as $parameter) {
            $routeName = $parameter->getName();
            $output[$routeName] = $params[$routeName];
        }

        return $output;
    }

}

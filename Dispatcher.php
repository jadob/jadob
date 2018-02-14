<?php

namespace Jadob\Core;

use ReflectionMethod;
use Jadob\Container\Container;
use Jadob\Core\Exception\DispatcherException;
use Jadob\EventListener\Event\AfterControllerEvent;
use Jadob\EventListener\Event\AfterRouterEvent;
use Jadob\EventListener\EventListener;
use Jadob\Router\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Zend\Config\Config;

/**
 * Class Dispatcher
 * @package Jadob\Core
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
     * @return EventListener
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
     */
    protected function getEventDispatcher()
    {
        return $this->container->get('event.listener');
    }

    /**
     * @param Request $request
     * @return Response
     * @throws \RuntimeException
     * @throws \ReflectionException
     * @throws DispatcherException
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
     */
    public function execute(Request $request)
    {
        // TODO: what we should do before finding a route and what we should pass?
        //$this->getEventDispatcher()->dispatchEvent('event.before.router');

        /** @var Route $route */
        $route = $this->container->get('router')->matchRoute($request);

        $afterRouterObject = new AfterRouterEvent($route, null);


        $this->getEventDispatcher()->dispatchAfterRouterAction($afterRouterObject);

        $route = $afterRouterObject->getRoute();

        if (($afterRouterResponse = $afterRouterObject->getResponse()) !== null) {
            return $afterRouterResponse;
        }


        $controllerClassName = $route->getController();

        if (!class_exists($controllerClassName)) {
            throw new DispatcherException('Class "' . $controllerClassName . '" '
                . 'does not exists or it cannot be used as a controller.');
        }

        $this->getEventDispatcher()->dispatchEvent('event.before.controller');

        $controllerConstructorArgs = $this->getControllerConstructorArguments($controllerClassName);
        $controller = new $controllerClassName(...$controllerConstructorArgs);

        $action = $route->getAction();

        if ($action !== '__invoke') {
            $action .= 'Action';
        }

        if (!method_exists($controller, $action)) {
            throw new DispatcherException('Action "' . $action . '" does not exists in ' . get_class($controller));
        }

        $params = $this->getOrderedParamsForAction($controller, $action, $route);

        /** @var Response $response */
        $response = \call_user_func_array([$controller, $action], $params);

        $afterControllerEvent = new AfterControllerEvent($response);

        $afterControllerListener = $this->getEventDispatcher()->dispatchAfterControllerAction($afterControllerEvent);

        if ($afterControllerListener !== null) {
            $response = $afterControllerListener;
        }

        $response->prepare($request);
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

    /**
     * @param $className
     * @return array
     * @throws \RuntimeException
     * @throws \ReflectionException
     */
    private function getControllerConstructorArguments($className)
    {

        $reflection = new \ReflectionClass($className);

        $controllerConstructor = $reflection->getConstructor();

        if($controllerConstructor === null) {
            return [];
        }

        $controllerParameters = $controllerConstructor->getParameters();

        $controllerConstructorArgs = [];

        foreach ($controllerParameters as $parameter) {

            if ($parameter->getType() === null) {
                throw new \RuntimeException('Constructor argument "' . $parameter->getName() . '" has no type.');
            }

            $argumentType = $parameter->getType()->getName();
            if ($argumentType === Container::class) {
                $controllerConstructorArgs[] = $this->container;
                break;
            }

            $controllerConstructorArgs[] = $this->container->findServiceByClassName($argumentType);
        }

        return $controllerConstructorArgs;

    }
}

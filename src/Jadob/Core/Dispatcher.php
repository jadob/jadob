<?php

namespace Jadob\Core;

use Jadob\Container\Container;
use Jadob\Router\Route;

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
     * @var Container
     */
    private $container;

    /**
     * Dispatcher constructor.
     * @param string $env
     * @param Config $config
     * @param Container $container
     */
    public function __construct($env, Container $container)
    {
        $this->env = $env;
        $this->container = $container;
    }

    /**
     * @param $controller
     * @param $action
     * @param Route $route
     * @return array
     * @throws \ReflectionException
     */
    public function getOrderedParamsForAction($controller, $action, Route $route): array
    {
        $reflection = new \ReflectionMethod($controller, $action);

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

        if ($controllerConstructor === null) {
            return [];
        }

        $controllerParameters = $controllerConstructor->getParameters();
        $controllerConstructorArgs = [];

        foreach ($controllerParameters as $parameter) {

            if ($parameter->getType() === null) {
                throw new \RuntimeException('Constructor argument "' . $parameter->getName() . '" has no type.');
            }

            $argumentType = (string)$parameter->getType();
            if ($argumentType === Container::class) {
                $controllerConstructorArgs[] = $this->container;
                break;
            }

            $controllerConstructorArgs[] = $this->container->findServiceByClassName($argumentType);
        }

        return $controllerConstructorArgs;

    }

    /**
     * Finds depedencies for controller object and instatiate it.
     * @param string $controllerClassName
     * @return mixed
     * @throws \RuntimeException
     * @throws \ReflectionException
     */
    public function autowireControllerClass($controllerClassName)
    {
        $controllerConstructorArgs = $this->getControllerConstructorArguments($controllerClassName);
        return new $controllerClassName(...$controllerConstructorArgs);
    }
}
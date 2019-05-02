<?php

namespace Jadob\Core;

use Jadob\Container\Container;
use Jadob\Core\Exception\KernelException;
use Jadob\Router\Router;
use Psr\Container\ContainerInterface;
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
     * @throws \Jadob\Router\Exception\RouteNotFoundException
     * @throws KernelException
     */
    public function executeRequest(Request $request)
    {
        /** @var Router $router */
        $router = $this->container->get('router');

        $route = $router->matchRequest($request);

        $controllerClass = $route->getController();

        if ($controllerClass === null) {
            throw new KernelException('Route ' . $route->getName() . ' should provide a valid FQCN or Closure, null given');
        }

        $autowiredController = $this->autowireControllerClass($controllerClass);

        if (!method_exists($autowiredController, $route->getAction())) {
            throw new KernelException('Controller ' . $controllerClass . ' has not method called ' . $route->getAction());
        }

        $response = \call_user_func_array([$autowiredController, $route->getAction()], $route->getParams());

        if (!($response instanceof Response)) {
            throw new KernelException('Controller '.\get_class($autowiredController).'#'.$route->getAction().' should return an instance of ' . Response::class . ', ' . \gettype($response) . ' returned');
        }

        return $response;
    }

    /**
     * @param $controllerClassName
     * @return mixed
     * @throws \ReflectionException
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
     * @throws KernelException
     */
    protected function autowireControllerClass($controllerClassName)
    {
        $reflection = new \ReflectionClass($controllerClassName);
        $classConstructor = $reflection->getConstructor();
        $arguments = [];

        if ($classConstructor === null) {
            return new $controllerClassName;
        }

        foreach ($classConstructor->getParameters() as $parameter) {
            if (!$parameter->hasType()) {
                throw new KernelException('Argument "' . $parameter->getName() . '" defined in ' . $controllerClassName . ' does not have any type.');
            }

            $type = (string)$parameter->getType();
            if ($type === ContainerInterface::class) {
                $arguments[] = $this->container;
            } else {
                $arguments[] = $this->container->findObjectByClassName($type);
            }
        }

        return new $controllerClassName(...$arguments);
    }
}
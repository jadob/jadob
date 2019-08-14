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
     * @throws \ReflectionException
     * @throws \Jadob\Router\Exception\MethodNotAllowedException
     */
    public function executeRequest(Request $request): Response
    {
        /** @var Router $router */
        $router = $this->container->get('router');

        $route = $router->matchRequest($request);

        $controllerClass = $route->getController();

        if ($controllerClass === null) {
            throw new KernelException('Route ' . $route->getName() . ' should provide a valid FQCN or Closure, null given');
        }

        $autowiredController = $this->autowireControllerClass($controllerClass);
        $methodName = $route->getAction();

        //@TODO: refactor method name resolving
        if ($methodName === null) {
            if (\method_exists($autowiredController, '__invoke')) {
                $methodName = '__invoke';
            } else {
                throw new KernelException('Controller ' . $controllerClass . ' does not have nor "action" key in routing or "__invoke" method.');
            }
        }

        if (!\method_exists($autowiredController, $methodName)) {
            throw new KernelException('Controller ' . $controllerClass . ' has not method called ' . $route->getAction());
        }

        //@TODO: check if method is accessible

        $methodArguments = $this->resolveControllerMethodArguments($autowiredController, $methodName, $route->getParams());

        $response = \call_user_func_array([$autowiredController, $methodName], $methodArguments);

        if (!($response instanceof Response)) {
            throw new KernelException('Controller ' . \get_class($autowiredController) . '#' . $route->getAction() . ' should return an instance of ' . Response::class . ', ' . \gettype($response) . ' returned');
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

        /**
         * There is no reasons for class autowiring when there is no constructor
         */
        if ($classConstructor === null) {
            return new $controllerClassName;
        }

        $arguments = [];
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

    /**
     * Allows for inject container services directly to method.
     *
     * @param object $controllerClass instantiated controller class
     * @param string $methodName method to be called later
     * @param array $routerParams arguments resolved from route
     * @return array
     * @throws \ReflectionException
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
     */
    protected function resolveControllerMethodArguments($controllerClass, $methodName, array $routerParams)
    {
        $reflection = new \ReflectionMethod($controllerClass, $methodName);

        $parameters = $reflection->getParameters();

        //nothing to do here
        if (\count($parameters) === 0) {
            return [];
        }

        $output = [];
        foreach ($parameters as $parameter) {
            $name = $parameter->getName();
            $type = $parameter->getType();

            //assume that if current function argument is an route parameter if there is no type
            if ($type === null && isset($routerParams[$name])) {
                $output[$name] = $routerParams[$name];
                continue;
            }

            //service requested
            if ($type !== null && !$type->isBuiltin()) {
                $output[$name] = $this->container->findObjectByClassName($type);
                continue;
            }

            throw new \RuntimeException('Missing service or route param with name "'.$name.'"');
        }

        return $output;
    }
}
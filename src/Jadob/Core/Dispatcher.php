<?php

namespace Jadob\Core;

use InvalidArgumentException;
use Jadob\Container\Container;
use Jadob\Container\Exception\AutowiringException;
use Jadob\Container\Exception\ServiceNotFoundException;
use Jadob\Core\Exception\KernelException;
use Jadob\EventDispatcher\EventDispatcher;
use Jadob\Router\Exception\MethodNotAllowedException;
use Jadob\Router\Exception\RouteNotFoundException;
use Jadob\Router\Router;
use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use RuntimeException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use function call_user_func_array;
use function count;
use function get_class;
use function gettype;
use function method_exists;

/**
 * Class Dispatcher
 *
 * @package Jadob\Core
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class Dispatcher
{

    /**
     * @var Container
     */
    protected $container;

    /**
     * @var EventDispatcherInterface
     */
    protected $eventDispatcher;

    /**
     * @var array
     */
    protected $config;

    /**
     * Dispatcher constructor.
     *
     * @param array $config
     * @param Container $container
     * @param EventDispatcherInterface|null $eventDispatcher
     */
    public function __construct(array $config, Container $container, ?EventDispatcherInterface $eventDispatcher = null)
    {
        $this->config = $config;
        $this->container = $container;

        if ($eventDispatcher === null) {
            $this->eventDispatcher = new EventDispatcher();
        }

    }

    /**
     * @param Request $request
     * @return Response
     * @throws InvalidArgumentException
     * @throws ServiceNotFoundException
     * @throws RouteNotFoundException
     * @throws KernelException
     * @throws ReflectionException
     * @throws MethodNotAllowedException
     * @throws AutowiringException
     */
    public function executeRequest(Request $request): Response
    {
        /**
         * @var Router $router
         */
        $router = $this->container->get('router');

        $route = $router->matchRequest($request);

        $controllerClass = $route->getController();

        if ($controllerClass === null) {
            throw KernelException::invalidControllerPassed($route->getName());
        }

        $autowiredController = $this->autowireControllerClass($controllerClass);
        $methodName = $route->getAction();

        //@TODO: refactor method name resolving
        if ($methodName === null) {
            if (method_exists($autowiredController, '__invoke')) {
                $methodName = '__invoke';
            } else {
                throw new KernelException('Controller ' . $controllerClass . ' does not have nor "action" key in routing or "__invoke" method.');
            }
        }

        if (!method_exists($autowiredController, $methodName)) {
            throw new KernelException('Controller ' . $controllerClass . ' has not method called ' . $route->getAction());
        }

        //@TODO: check if method is accessible

        $methodArguments = $this->resolveControllerMethodArguments($autowiredController, $methodName, $route->getParams());

        $response = call_user_func_array([$autowiredController, $methodName], $methodArguments);

        if (!($response instanceof Response)) {
            throw new KernelException('Controller ' . get_class($autowiredController) . '#' . $route->getAction() . ' should return an instance of ' . Response::class . ', ' . gettype($response) . ' returned');
        }

        return $response;
    }

    /**
     * @param  $controllerClassName
     * @return mixed
     * @throws ReflectionException
     * @throws ServiceNotFoundException
     * @throws KernelException
     * @throws AutowiringException
     */
    protected function autowireControllerClass($controllerClassName)
    {
        $autowireEnabled = (bool)$this->config['autowire_controller_arguments'];

        $reflection = new ReflectionClass($controllerClassName);
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
                //TODO Refactor or move to another method
                try {
                    $arguments[] = $this->container->findObjectByClassName($type);
                } catch (ServiceNotFoundException $exception) {
                    if ($autowireEnabled) {
                        $arguments[] = $this->container->autowire($type);
                    } else {
                        throw  $exception;
                    }
                }
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
     * @throws ReflectionException
     * @throws ServiceNotFoundException
     * @throws AutowiringException
     */
    protected function resolveControllerMethodArguments($controllerClass, $methodName, array $routerParams): array
    {
        $autowireEnabled = (bool)$this->config['autowire_controller_arguments'];
        $reflection = new ReflectionMethod($controllerClass, $methodName);

        $parameters = $reflection->getParameters();

        //nothing to do here
        if (count($parameters) === 0) {
            return [];
        }

        $output = [];
        foreach ($parameters as $parameter) {
            $name = $parameter->getName();
            $type = $parameter->getType();

            if (
                isset($routerParams[$name])
                //assuming that router param has builtin type defined, or does not defined at all
                && ($type === null || ($type !== null && $type->isBuiltin()))
            ) {
                $output[$name] = $routerParams[$name];
                continue;
            }

            //service requested
            if ($type !== null && !$type->isBuiltin()) {
                //TODO Refactor or move to another method
                try {
                    $output[$name] = $this->container->findObjectByClassName($type);
                } catch (ServiceNotFoundException $exception) {
                    if ($autowireEnabled) {
                        $output[$name] = $this->container->autowire($type);
                    } else {
                        throw $exception;
                    }
                }
                continue;
            }

            throw new RuntimeException('Missing service or route parameter with name "' . $name . '"');
        }
        return $output;
    }
}
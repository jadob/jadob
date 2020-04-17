<?php
declare(strict_types=1);

namespace Jadob\Core;

use Closure;
use Jadob\Container\Container;
use Jadob\Container\Exception\AutowiringException;
use Jadob\Container\Exception\ServiceNotFoundException;
use Jadob\Core\Exception\KernelException;
use Jadob\Router\Exception\MethodNotAllowedException;
use Jadob\Router\Exception\RouteNotFoundException;
use Jadob\Router\Route;
use Jadob\Router\Router;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Http\Message\RequestInterface;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use RuntimeException;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use function call_user_func_array;
use function count;
use function get_class;
use function gettype;
use function in_array;
use function method_exists;

/**
 *
 * @internal
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
    public function __construct(array $config, Container $container, EventDispatcherInterface $eventDispatcher = null)
    {
        $this->config = $config;
        $this->container = $container;
        $this->eventDispatcher = $eventDispatcher;
    }

    /**
     * @param RequestContext $context
     * @return Response
     * @throws AutowiringException
     * @throws KernelException
     * @throws MethodNotAllowedException
     * @throws ReflectionException
     * @throws RouteNotFoundException
     * @throws ServiceNotFoundException
     */
    public function executeRequest(RequestContext $context): Response
    {
        /**
         * @var Router $router
         */
        $router = $this->container->get('router');

        $route = $router->matchRequest($context->getRequest());

        $context->setContext($router->getContext());
        $context->setRoute($route);

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

        $methodArguments = $this->resolveControllerMethodArguments(
            $autowiredController,
            $methodName,
            $route->getParams(),
            $context
        );

        $response = call_user_func_array([$autowiredController, $methodName], $methodArguments);

        if (!($response instanceof Response)) {
            throw new KernelException('Controller ' . get_class($autowiredController) . '#' . $route->getAction() . ' should return an instance of ' . Response::class . ', ' . gettype($response) . ' returned');
        }

        return $response;
    }

    /**
     * @param  $controllerClassName
     * @return mixed
     * @throws AutowiringException
     * @throws KernelException
     * @throws ReflectionException
     * @throws ServiceNotFoundException
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
     * @param RequestContext $context
     * @return array
     * @throws AutowiringException
     * @throws ReflectionException
     * @throws ServiceNotFoundException
     */
    protected function resolveControllerMethodArguments(
        $controllerClass,
        $methodName,
        array $routerParams,
        RequestContext $context
    ): array
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
                try {
                    $class = (string)$type;
                    /**
                     * try to match request object first
                     */
                    if (($request = $this->matchRequestObject($class, $context)) !== null) {
                        $output[$name] = $request;
                        continue;
                    }

                    /**
                     * Current matched route is passed to given argument
                     */
                    if ($class === Route::class) {
                        $output[$name] = $context->getRoute();
                        continue;
                    }

                    /**
                     * Then look in container for existing class
                     */
                    $output[$name] = $this->container->findObjectByClassName($class);
                } catch (ServiceNotFoundException $exception) {
                    if ($autowireEnabled) {
                        /**
                         * Try to autowire if enabled in dispatcher configuration
                         */
                        $output[$name] = $this->container->autowire((string)$type);
                    } else {
                        /**
                         * Break if all possibilities gave no results
                         */
                        throw $exception;
                    }
                }
                continue;
            }

            throw new RuntimeException('Missing service or route parameter with name "' . $name . '"');
        }
        return $output;
    }

    /**
     * @param Request $request
     * @return RequestInterface
     */
    protected function convertRequestToPsr7Complaint(Request $request): RequestInterface
    {
        /**
         * Allows to use user defined factory for PSR Requests
         */
        if (isset($this->config['psr7_converter'])) {
            /** @var Closure $userDefinedConverter */
            $userDefinedConverter = $this->config['psr7_converter'];
            return $userDefinedConverter($request);
        }

        /**
         * There is no reason to use separate instance for any request interface
         */
        $psr17Factory = new Psr17Factory();
        $psrHttpFactory = new PsrHttpFactory(
            $psr17Factory,
            $psr17Factory,
            $psr17Factory,
            $psr17Factory
        );

        return $psrHttpFactory->createRequest($request);
    }

    /**
     * @param string $className
     * @param RequestContext $context
     * @return Request|RequestInterface|null
     */
    protected function matchRequestObject(string $className, RequestContext $context): ?object
    {
        if (
            $className === Request::class
            || in_array(Request::class, class_parents($className), true) // an instanceof Request has been passed to execute() method
        ) {
            return $context->getRequest();
        }

        if (
            $context->isPsr7Complaint()
            && (
                in_array(RequestInterface::class, class_implements($className), true)
                || $className === RequestInterface::class
            )
        ) {
            $this->convertRequestToPsr7Complaint($context->getRequest());
        }

        return null;

    }

}
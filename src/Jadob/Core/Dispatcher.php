<?php
declare(strict_types=1);

namespace Jadob\Core;

use Closure;
use Jadob\Container\Container;
use Jadob\Container\Exception\AutowiringException;
use Jadob\Container\Exception\ServiceNotFoundException;
use Jadob\Core\Event\AfterControllerEvent;
use Jadob\Core\Event\BeforeControllerEvent;
use Jadob\Core\Exception\KernelException;
use Jadob\Router\Exception\MethodNotAllowedException;
use Jadob\Router\Exception\RouteNotFoundException;
use Jadob\Router\Route;
use Jadob\Router\Router;
use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use RuntimeException;
use Symfony\Bridge\PsrHttpMessage\Factory\PsrHttpFactory;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use function call_user_func_array;
use function get_class;
use function gettype;
use function in_array;
use function method_exists;

/**
 * @internal
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class Dispatcher
{

    /**
     * @var Container
     */
    protected Container $container;

    /**
     * @var EventDispatcherInterface
     */
    protected ?EventDispatcherInterface $eventDispatcher;

    /**
     * @var array
     */
    protected array $config;

    /**
     * @var LoggerInterface
     */
    protected LoggerInterface $logger;

    /**
     * @var PsrHttpFactory
     */
    protected PsrHttpFactory $psrHttpFactory;

    /**
     * Dispatcher constructor.
     *
     * @param array $config
     * @param Container $container
     * @param LoggerInterface $logger
     * @param EventDispatcherInterface|null $eventDispatcher
     */
    public function __construct(
        array $config,
        Container $container,
        LoggerInterface $logger,
        EventDispatcherInterface $eventDispatcher
    )
    {
        $this->config = $config;
        $this->container = $container;
        $this->logger = $logger;
        $this->eventDispatcher = $eventDispatcher;

        /**
         * There is no reason to use separate instance for any request interface
         */
        $psr17Factory = new Psr17Factory();
        $this->psrHttpFactory = new PsrHttpFactory(
            $psr17Factory,
            $psr17Factory,
            $psr17Factory,
            $psr17Factory
        );
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

        /**
         * Add information about matched route to request object
         */
        $context->getRequest()->attributes->set('path_name', $route->getName());
        $context->getRequest()->attributes->set('current_route', $route);

        $beforeControllerEvent = new BeforeControllerEvent($context);
        $this->eventDispatcher->dispatch($beforeControllerEvent);
        $beforeControllerEventResponse = $beforeControllerEvent->getResponse();

        if ($beforeControllerEventResponse !== null) {
            $this->logger->debug('Received response from BeforeControllerEvent, further execution is stopped.');
            return $beforeControllerEventResponse;
        }


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

        /**
         * Convert response to HTTP Foundation before passing them to AfterController Event
         */
        if ($context->isPsr7Compliant() && ($response instanceof ResponseInterface)) {
            $response = (new HttpFoundationFactory())->createResponse($response);
        }

        if (!($response instanceof Response)) {
            throw new KernelException('Controller ' . get_class($autowiredController) . '#' . $route->getAction() . ' should return an instance of ' . Response::class . ', ' . gettype($response) . ' returned');
        }

        $afterControllerEvent = new AfterControllerEvent($response);
        $this->eventDispatcher->dispatch($afterControllerEvent);

        if ($afterControllerEvent->getResponse() !== null) {
            $this->logger->debug('Received response from AfterControllerEvent.');
            return $afterControllerEvent->getResponse();
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
        $output = [];

        foreach ($parameters as $parameter) {
            $name = $parameter->getName();
            $type = $parameter->getType();

            /**
             * At first, pass the route parameters
             */
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
                     * Detects that request object has been requested
                     */
                    if (($request = $this->matchRequestObject($class, $context)) !== null) {
                        $output[$name] = $request;
                        continue;
                    }

                    /**
                     * Detect that Route was requested.
                     * When true, then current route will be injected.
                     */
                    if ($class === Route::class) {
                        $output[$name] = $context->getRoute();
                        continue;
                    }

                    /**
                     * Looks for given service in container.
                     */
                    $output[$name] = $this->container->findObjectByClassName($class);
                } catch (ServiceNotFoundException $exception) {
                    /**
                     * When container does not have nothing interesting, lets try to autowire a class that we need
                     */
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
                /**
                 * Exit current iteration
                 */
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

        return $this->psrHttpFactory->createRequest($request);
    }

    /**
     * Allows to inject proper request object.
     *
     * @param string $className
     * @param RequestContext $context
     * @return Request|RequestInterface|null
     */
    protected function matchRequestObject(string $className, RequestContext $context): ?object
    {
        if ($context->isPsr7Complaint()) {
            if (
                in_array(RequestInterface::class, class_implements($className), true)
                || $className === RequestInterface::class
            ) {
                return $this->convertRequestToPsr7Complaint($context->getRequest());
            }

            if (
                in_array(ResponseInterface::class, class_implements($className), true)
                || $className === ResponseInterface::class
            ) {
                return new \Nyholm\Psr7\Response();
            }
        }

        if (
            $className === Request::class
            || in_array(Request::class, class_parents($className), true) // an user-defined instanceof Request has been passed to execute() method
        ) {
            return $context->getRequest();
        }
        return null;
    }

}
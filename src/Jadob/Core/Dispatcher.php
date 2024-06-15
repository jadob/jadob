<?php
declare(strict_types=1);

namespace Jadob\Core;

use function call_user_func_array;
use Closure;
use Exception;
use function get_class;
use function gettype;
use function in_array;
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
use Jadob\Security\Auth\User\UserInterface;
use function method_exists;
use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Log\LoggerInterface;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;
use ReflectionNamedType;
use RuntimeException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @internal
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class Dispatcher
{
    protected Container $container;

    protected bool $verbose = false;

    protected EventDispatcherInterface $eventDispatcher;

    protected array $config;

    protected LoggerInterface $logger;

    public function __construct(
        array $config,
        Container $container,
        LoggerInterface $logger,
        EventDispatcherInterface $eventDispatcher
    ) {
        $this->config = $config;
        $this->container = $container;
        $this->logger = $logger;
        $this->eventDispatcher = $eventDispatcher;

        $this->verbose = $this->config['verbose'] ?? false;

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


        if (!($response instanceof Response)) {
            //@TODO named constructor
            throw new KernelException(
                'Controller ' . get_class($autowiredController) . '#' . $route->getAction() . ' should return an instance of ' . Response::class . ', ' . gettype($response) . ' returned'
            );
        }

        $afterControllerEvent = new AfterControllerEvent($response, $context);
        $this->eventDispatcher->dispatch($afterControllerEvent);

        if ($afterControllerEvent->getResponse() !== null) {
            $this->logger->debug('Received response from AfterControllerEvent.');
            return $afterControllerEvent->getResponse();
        }

        return $response;
    }

    /**
     * @psalm-param class-string $controllerClassName
     * @param string $controllerClassName
     * @throws AutowiringException
     * @throws KernelException
     * @throws ReflectionException
     * @throws ServiceNotFoundException
     */
    protected function autowireControllerClass(string $controllerClassName): object
    {
        $autowireEnabled = (bool) $this->config['autowire_controller_arguments'];

        $reflection = new ReflectionClass($controllerClassName);
        $classConstructor = $reflection->getConstructor();

        /**
         * There is no reasons for class autowiring when there is no constructor
         */
        if ($classConstructor === null) {
            $this->verbose && $this->logger->debug(
                sprintf('Skipping autowiring for "%s" as it does not have a constructor.', $controllerClassName)
            );

            /** @psalm-suppress MixedMethodCall */
            return new $controllerClassName();
        }

        $arguments = [];
        foreach ($classConstructor->getParameters() as $parameter) {
            if (!$parameter->hasType()) {
                throw new KernelException('Argument "' . $parameter->getName() . '" defined in ' . $controllerClassName . ' does not have any type.');
            }

            /** @var ReflectionNamedType $parameterType */
            $parameterType = $parameter->getType();
            $type = $parameterType->getName();

            if ($type === ContainerInterface::class) {
                $arguments[] = $this->container;
                continue;
            }

            $objectByFqcn = $this->container->findObjectByClassName($type);
            if ($objectByFqcn !== null) {
                $this->verbose && $this->logger->debug(
                    sprintf('Found "%s" service for type "%s"', get_class($objectByFqcn), $type)
                );

                $arguments[] = $objectByFqcn;
                continue;
            }

            if ($autowireEnabled) {
                $autowiredService = $this->container->autowire($type);
                $this->verbose && $this->logger->debug(
                    sprintf('Autowired "%s" service for type "%s"', get_class($autowiredService), $type)
                );

                $arguments[] = $autowiredService;
                continue;
            }

            throw new KernelException(
                sprintf(
                    'Unable to autowire controller "%s" because service "%s" is not found in container and cannot be autowired as "%s" is false.',
                    $controllerClassName,
                    $type,
                    'framework.autowire_controller_arguments'
                )
            );
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
     * @throws \Jadob\Container\Exception\ContainerException
     */
    protected function resolveControllerMethodArguments(
        $controllerClass,
        $methodName,
        array $routerParams,
        RequestContext $context
    ): array {
        $autowireEnabled = (bool) $this->config['autowire_controller_arguments'];
        $methodReflection = new ReflectionMethod($controllerClass, $methodName);

        $methodParameters = $methodReflection->getParameters();
        $output = [];

        foreach ($methodParameters as $parameter) {
            $parameterName = $parameter->getName();
            /** @var ReflectionNamedType $parameterType */
            $parameterType = $parameter->getType();

            /**
             * At first, pass the route parameters
             */
            if (
                isset($routerParams[$parameterName])
                //assuming that router param has builtin type defined, or does not defined at all
                && ($parameterType === null || ($parameterType !== null && $parameterType->isBuiltin()))
            ) {
                $output[$parameterName] = $routerParams[$parameterName];
                continue;
            }

            //service or something from RequestContext requested
            if ($parameterType !== null && !$parameterType->isBuiltin()) {
                $class = $parameterType->getName();

                if (($request = $this->matchRequestObject($class, $context)) !== null) {
                    $output[$parameterName] = $request;
                    continue;
                }

                if ($class === Route::class) {
                    $output[$parameterName] = $context->getRoute();
                    continue;
                }

                /**
                 * When still here, try to get a service from container or autowire them
                 */
                $service = $this->container->findObjectByClassName($class);

                if ($service !== null) {
                    $output[$parameterName] = $service;
                    continue;
                }

                if ($autowireEnabled) {
                    $output[$parameterName] = $this->container->autowire($class);
                    continue;
                }

                /**
                 * Exit current iteration as requested dependency has been found
                 */
                continue;
            }

            throw new RuntimeException('Missing service or route parameter with name "' . $parameterName . '"');
        }
        return $output;
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
        if (
            in_array(RequestContext::class, class_parents($className), true)
            || $className === RequestContext::class
        ) {
            return $context;
        }

        if (
            in_array(UserInterface::class, class_parents($className), true)
            || $className === UserInterface::class
        ) {
            $user = $context->getUser();
            if ($user === null) {
                throw new Exception('Could not autowire user to controller as user seem to be not authenticated.');
            }

            return $user;
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
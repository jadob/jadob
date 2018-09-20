<?php

namespace Jadob\Core;

use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\EventListener\Event\AfterRouterEvent;
use Jadob\EventListener\Event\AfterControllerEvent;
use Jadob\EventListener\EventListener;
use Jadob\Router\Exception\RouteNotFoundException;
use Jadob\Router\Router;
use Symfony\Component\HttpFoundation\Request;
use Jadob\Debug\Handler\ExceptionHandler;

/**
 * Front Controller of your application.
 * @package Jadob\Core
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class Kernel
{
    /**
     * Framework version.
     * @var string
     */
    const VERSION = '0.70.0';

    /**
     * @var [][]
     */
    protected $config;

    /**
     * @var Container
     */
    protected $container;

    /**
     * @var FrameworkConfiguration
     */
    protected $frameworkConfiguration;

    /**
     * @var EventListener
     */
    protected $eventListener;

    /**
     * @param string $env
     * @param BootstrapInterface $bootstrap
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    public function __construct($env, BootstrapInterface $bootstrap)
    {
        StaticPerformanceTimer::addEntry('framework.start');
        $this->env = strtolower($env);
        $this->bootstrap = $bootstrap;
        /** @noinspection PhpIncludeInspection */
        $this->config = include $this->bootstrap->getConfigDir() . '/config.php';

        if (!isset($this->config['framework'])) {
            throw new \RuntimeException('Configuration file does not have "framework" node.');

        }

        $this->eventListener = new EventListener();

        $this->container = $this->buildContainer();

        $this->exceptionHandler = new ExceptionHandler($env);
        $this->exceptionHandler
            ->registerErrorHandler()
            ->registerExceptionHandler();

    }

    protected function buildContainer()
    {
        StaticPerformanceTimer::addEntry('container.providers.start');
        /**
         * Register providers first
         */
        $coreServiceProviders = include __DIR__ . '/Resources/data/framework_service_providers.php';
        $userDefinedProviders = $this->bootstrap->getServiceProviders();

        /** @var ServiceProviderInterface[] $services */
        $serviceProviders = array_merge($coreServiceProviders, $userDefinedProviders);

        $container = new Container();

        $container->add('request', Request::createFromGlobals());
        $container->add('bootstrap', $this->bootstrap);
        $container->add('event.listener', $this->eventListener);

        $container->registerProviders($serviceProviders, $this->config);

        StaticPerformanceTimer::addEntry('container.providers.stop');

        /**
         * Register single services, provided in services.php
         */
        $servicesFile = $this->bootstrap->getConfigDir() . '/services.php';

        if (\file_exists($servicesFile)) {
            $services = include $servicesFile;

            foreach ($services as $name => $object) {
                $container->add($name, $object);
            }
        }

        StaticPerformanceTimer::addEntry('container.services.stop');


        return $container;
    }

    public function execute()
    {
        StaticPerformanceTimer::addEntry('kernel.execute');
        StaticPerformanceTimer::addEntry('router.start');

        $dispatcher = new Dispatcher($this->env, $this->container);

        $route = $this->matchRoute();

        if ($route === null) {
            $route = $this->frameworkConfiguration->getErrorControllerRoute();
        }

        $afterRouteEvent = new AfterRouterEvent($route);

        $this->eventListener->dispatchAfterRouterAction($afterRouteEvent);

        if ($afterRouteEvent->getResponse() !== null) {
            return $afterRouteEvent->getResponse();
        }

        $controllerClassName = $route->getController();

        if (!\class_exists($controllerClassName)) {
            throw new DispatcherException('Class "' . $controllerClassName . '" '
                . 'does not exists or it cannot be used as a controller.');
        }

        $controller = $dispatcher->autowireControllerClass($controllerClassName);


        $action = $route->getAction();

        if ($action === null && !method_exists($controller, '__invoke')) {
            throw new \RuntimeException('Class "' . \get_class($controller) . '" has neither action nor __invoke() method defined.');
        }

        $action = ($action === null) ? '__invoke' : $action . 'Action';

        if (!method_exists($controller, $action)) {
            throw new DispatcherException('Action "' . $action . '" does not exists in ' . \get_class($controller));
        }

        $params = $dispatcher->getOrderedParamsForAction($controller, $action, $route);

        /** @var Response $response */
        $response = \call_user_func_array([$controller, $action], $params);

        $afterControllerEvent = new AfterControllerEvent($response);

        $response = $this->eventListener->dispatchAfterControllerAction($afterControllerEvent);

        /**
         * enable pretty print for JsonResponse objects in dev environment
         */
        if ($response instanceof JsonResponse && $this->env === 'dev') {
            $response->setEncodingOptions($response->getEncodingOptions() | JSON_PRETTY_PRINT);
        }

        return $response;

    }

    /**
     * @return \Jadob\Router\Route|null
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
     */
    protected function matchRoute()
    {
        /** @var Router $router */
        $router = $this->container->get('router');
        /** @var Request $request */
        $request = $this->container->get('request');

        try {
            $route = $router->matchRoute($request);
        } catch (RouteNotFoundException $e) {
            /**
             * Throw exception in development mode.
             */
            if ($this->env === 'dev') {
                throw  $e;
            }

            return null;
        }

        return $route;
    }
}
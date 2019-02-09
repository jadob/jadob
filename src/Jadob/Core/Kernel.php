<?php

namespace Jadob\Core;

use Jadob\Container\Container;
use Jadob\Container\ContainerBuilder;
use Jadob\Core\Exception\KernelException;
use Jadob\EventListener\Event\BeforeControllerEvent;
use Jadob\EventListener\Event\Type\BeforeControllerEventListenerInterface;
use Jadob\EventListener\EventListener;
use Jadob\Router\Router;
use Jadob\Security\Guard\Guard;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class Kernel
 * @TODO:
 * - after container build event
 * @package Jadob\Core
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class Kernel
{

    public const VERSION = '0.0.60';

    /**
     * @var array
     */
    private $config;

    /**
     * @var string (dev/prod)
     */
    private $env;

    /**
     * @var Container
     */
    private $container;

    /**
     * @var BootstrapInterface
     */
    private $bootstrap;

    /**
     * @var EventListener
     */
    protected $eventListener;

    /**
     * @var ContainerBuilder
     */
    protected $containerBuilder;

    /**
     * @param string $env
     * @param BootstrapInterface $bootstrap
     */
    public function __construct($env, BootstrapInterface $bootstrap)
    {
        $this->env = strtolower($env);
        $this->bootstrap = $bootstrap;

        $this->eventListener = new EventListener();

        $this->addEvents();

        $this->config = include $this->bootstrap->getConfigDir() . '/config.php';
    }

    /**
     * @param Request $request
     * @return Response
     * @throws KernelException
     * @throws \Jadob\Container\Exception\ContainerException
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
     * @throws \Jadob\Router\Exception\RouteNotFoundException
     * @throws \ReflectionException
     */
    public function execute(Request $request)
    {

        $builder = $this->getContainerBuilder();
        $builder->add('request', $request);
        $this->container = $builder->build($this->config);

        /** @var Router $router */
        $router = $this->container->get('router');
        $route = $router->matchRequest($request);

        $beforeControllerEvent = new BeforeControllerEvent($request);

        $this->eventListener->dispatchEvent($beforeControllerEvent);

        $beforeControllerEventResponse = $beforeControllerEvent->getResponse();

        #@TODO: this part below should be refactored: controller dispatching should be moved to another class
        if ($beforeControllerEventResponse !== null) {
            return $beforeControllerEventResponse;
        }

//        var_dump($this->container->get('symfony.form.factory'));
        $controllerClass = $route->getController();

        $autowiredController = $this->autowireControllerClass($controllerClass);

        if (!method_exists($autowiredController, $route->getAction())) {
            throw new KernelException('Controller ' . $controllerClass . ' has not method called ' . $route->getAction());
        }

        $response = \call_user_func_array([$autowiredController, $route->getAction()], $route->getParams());

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


            if($type === ContainerInterface::class) {
                $arguments[] = $this->container;
            } else {
                $arguments[] = $this->container->findObjectByClassName($type);
            }
        }

        return new $controllerClassName(...$arguments);
    }

    /**
     * @return Container
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @param ContainerInterface $container
     * @return Kernel
     */
    public function setContainer(ContainerInterface $container)
    {
        $this->container = $container;
        return $this;
    }


    /**
     * @return bool
     */
    public function isProduction()
    {
        return $this->env === 'prod';
    }

    /**
     * @return string
     */
    public function getEnv()
    {
        return $this->env;
    }

    protected function addEvents()
    {
        $this->eventListener->addEvent(
            BeforeControllerEvent::class,
            BeforeControllerEventListenerInterface::class,
            'onBeforeControllerInterface');
    }

    /**
     * @return ContainerBuilder
     */
    public function getContainerBuilder(): ContainerBuilder
    {
        if($this->containerBuilder === null) {
            /** @var array $services */
            $services = include $this->bootstrap->getConfigDir() . '/services.php';

            $containerBuilder = new ContainerBuilder();
            $containerBuilder->add('event.listener', $this->eventListener);
            $containerBuilder->add('bootstrap', $this->bootstrap);
            $containerBuilder->add('kernel', $this);
            $containerBuilder->setServiceProviders($this->bootstrap->getServiceProviders());

            foreach ($services as $serviceName => $serviceObject) {
                $containerBuilder->add($serviceName, $serviceObject);
            }

            $this->containerBuilder = $containerBuilder;
        }

        return $containerBuilder;
    }

    /**
     * @return array
     */
    public function getConfig(): array
    {
        return $this->config;
    }

    /**
     * @param array $config
     * @return Kernel
     */
    public function setConfig(array $config): Kernel
    {
        $this->config = $config;
        return $this;
    }

}

<?php

namespace Jadob\Core;

use Jadob\Container\Container;
use Jadob\Container\ContainerBuilder;
use Jadob\Core\Exception\KernelException;
use Jadob\Router\Router;
use Jadob\Security\Guard\Guard;
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
     * @param string $env
     * @param BootstrapInterface $bootstrap
     */
    public function __construct($env, BootstrapInterface $bootstrap)
    {
        $this->env = strtolower($env);
        $this->bootstrap = $bootstrap;
    }

    /**
     * @return Response
     * @throws \Jadob\Container\Exception\ContainerException
     */
    public function execute(Request $request)
    {

        $this->config = include $this->bootstrap->getConfigDir() . '/config.php';
        $services = include $this->bootstrap->getConfigDir() . '/services.php';

        $containerBuilder = new ContainerBuilder();
        $containerBuilder->add('request', $request);
        $containerBuilder->add('bootstrap', $this->bootstrap);
        $containerBuilder->add('kernel', $this);
        $containerBuilder->setServiceProviders($this->bootstrap->getServiceProviders());

        foreach ($services as $serviceName => $serviceObject) {
            $containerBuilder->add($serviceName, $serviceObject);
        }

        $this->container = $containerBuilder->build($this->config);

        /** @var Router $router */
        $router = $this->container->get('router');

        #@TODO: move this to listener
        /** @var Guard $guard */
        $guard = $this->container->get('guard');

        $guard->dispatchRequest($request);



        $route = $router->matchRequest($request);

        $controllerClass = $route->getController();

        $autowiredController = $this->autowireControllerClass($controllerClass);

        if(!method_exists($autowiredController, $route->getAction())) {
            throw new KernelException('Controller '.$controllerClass.' has not method called '.$route->getAction());
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

        if($classConstructor === null) {
            return new $controllerClassName;
        }

        foreach ($classConstructor->getParameters() as $parameter) {
            if (!$parameter->hasType()) {
                throw new KernelException('Argument "' . $parameter->getName() . '" defined in ' . $controllerClassName . ' does not have any type.');
            }

            $type = (string)$parameter->getType();

            $arguments[] = $this->container->findObjectByClassName($type);
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

}

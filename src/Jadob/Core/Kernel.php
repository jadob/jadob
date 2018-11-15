<?php

namespace Jadob\Core;

use Jadob\Container\Container;
use Jadob\EventListener\Event\BeforeControllerEvent;
use Jadob\EventListener\Event\Type\BeforeControllerEventListenerInterface;
use Jadob\EventListener\EventListener;
use Jadob\Router\Router;
use Jadob\Security\Auth\UserStorage;
use Jadob\Security\Firewall\Firewall;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class Kernel
 * @package Jadob\Core
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class Kernel
{

    /**
     * @var string
     */
    protected $env;

    /**
     * @var BootstrapInterface
     */
    protected $bootstrap;

    /**
     * @var Container
     */
    protected $container;

    /**
     * @var Router
     */
    protected $router;

    /**
     * @var array
     */
    protected $config;

    /**
     * @var EventListener
     */
    protected $eventListener;


    /**
     * Kernel constructor.
     * @param string $env application environment (dev/prod)
     * @param BootstrapInterface $bootstrap
     */
    public function __construct($env, BootstrapInterface $bootstrap)
    {
        $this->env = $env;
        $this->bootstrap = $bootstrap;
        $this->container = new Container();

        $this->config = include $bootstrap->getConfigDir() . '/config.php';
    }

    /**
     * @param Request $request
     * @return Response
     * @throws \Jadob\Container\Exception\ContainerException
     * @throws \Jadob\Router\Exception\RouteNotFoundException
     */
    public function execute(Request $request)
    {
        $this->container->add('request', $request);

        $this->buildCoreServices();
        $this->buildContainer();

        //match route
        $route = $this->router->matchRequest($request);

        $beforeControllerEvent = new BeforeControllerEvent($request);

        $this->eventListener->dispatchEvent($beforeControllerEvent);

//        r($this->container->get('firewall'));


        r('jestem aż tutaj moi drodzy');

        //check if user needs to be logged:

//        r($this->userStorage->getUser());

//        r($this->firewall->matchRequest())

    }

    protected function buildCoreServices()
    {
        $this->router = new Router($this->config['framework']['router']);

        $this->eventListener = new EventListener();

        //add before controller event
        $this->eventListener->addEvent(
            BeforeControllerEvent::class,
            BeforeControllerEventListenerInterface::class,
            'onBeforeControllerInterface'
        );

    }

    /**
     * @throws \Jadob\Container\Exception\ContainerException
     */
    protected function buildContainer(): void
    {
        $this->container->add('router', $this->router);
        $this->container->add('bootstrap', $this->bootstrap);
        $this->container->add('event.listener', $this->eventListener);

        $this->container->registerProviders(
            $this->bootstrap->getServiceProviders(),
            $this->config
        );

        //if there is any services.php in config file, add them
        $servicesFileLocation = $this->bootstrap->getConfigDir().'/services.php';

        if(\file_exists($servicesFileLocation)) {
            //@TODO: add "merge" or something like that method in container to merge arrays with services
            $userServices = include $servicesFileLocation;
            //@TODO werify if array passed
            foreach ($userServices as $userServiceKey => $userService) {
                $this->container->add($userServiceKey, $userService);
            }
        }

    }
}
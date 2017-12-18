<?php

namespace Slice\Core;

use Bootstrap;
use Slice\Container\Container;
use Slice\Debug\Handler\ExceptionHandler;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Zend\Config\Config;
use Zend\Config\Processor\Token;


/**
 * Class Kernel
 * @package Slice\Core
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class Kernel
{

    const VERSION = '0.28.1';

    /**
     * @var Config[]
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
     * @var Dispatcher
     */
    private $dispatcher;

    /**
     * @var ExceptionHandler
     */
    private $exceptionHandler;

    /**
     * @var Bootstrap
     */
    private $bootstrap;

    /**
     * @var Response
     */
    private $response;

    /**
     * @param string $env
     * @param Bootstrap $bootstrap
     */
    public function __construct($env, $bootstrap)
    {
        $this->env = $env;
        $this->bootstrap = $bootstrap;

        //Enable error handling

        $this->exceptionHandler = new ExceptionHandler($env);
        $this->exceptionHandler
            ->registerErrorHandler()
            ->registerExceptionHandler();

        $config = new Config(include $this->bootstrap->getConfigDir() . '/config.php', true);
        $parameters = new Config(include $this->bootstrap->getConfigDir() . '/parameters.php');

        $processor = new Token($parameters, '%{', '}');
        $processor->process($config);

        $this->config = $config;

        $this->container = $this->createContainer();

        $this->dispatcher = new Dispatcher($this->env, $this->config, $this->container);


    }

    /**
     * @return Container
     */
    private function createContainer()
    {
        $serviceProviders = include __DIR__ . '/Resources/data/framework_service_providers.php';
        $userDefinedProviders = $this->bootstrap->getServiceProviders();

        $services = array_merge($serviceProviders, $userDefinedProviders);

        $container = new Container();

        //register all singular core objects here
        $container->add('bootstrap', $this->bootstrap);
        $container->add('kernel', $this);
        $container->add('request', Request::createFromGlobals());

        foreach ($services as $service) {
            /** @var \Slice\Container\ServiceProvider\ServiceProviderInterface $provider * */
            $provider = new $service;

            $configNode = $provider->getConfigNode();
            $config = [];

            if ($configNode !== null) {
                $config = $this->config[$configNode]->toArray();
            }

            $provider->register($container, $config);
        }

        return $container;
    }

    /**
     * @return $this
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws Exception\DispatcherException
     * @throws \ReflectionException
     * @throws \Slice\Container\Exception\ContainerException
     * @throws \Slice\Container\Exception\ServiceNotFoundException
     */
    public function execute()
    {
        $this->response = $this->dispatcher->execute($this->container->get('request'));

        return $this;
    }

    /**
     * Sends all output (response headers, cookies, content) to browser.
     */
    public function send()
    {
        $this->response->send();
    }

}

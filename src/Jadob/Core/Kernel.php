<?php

namespace Jadob\Core;


use Jadob\Container\Container;
use Jadob\Debug\Handler\ExceptionHandler;
use Jadob\EventListener\EventListener;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Zend\Config\Config;
use Zend\Config\Processor\Token;

/**
 * Class Kernel
 * @package Jadob\Core
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class Kernel
{

    const VERSION = '0.52.0';

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
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param string $env
     * @param Bootstrap $bootstrap
     * @throws \InvalidArgumentException
     * @throws \Exception
     */
    public function __construct($env, BootstrapInterface $bootstrap)
    {
        $this->env = $env;
        $this->bootstrap = $bootstrap;

        //Enable error handling
        $this->createLogger();

        $this->exceptionHandler = new ExceptionHandler($env, $this->logger);
        $this->exceptionHandler
            ->registerErrorHandler()
            ->registerExceptionHandler();

        $config = new Config(include $this->bootstrap->getConfigDir() . '/config.php', true);

        $parameters = new Config(include $this->bootstrap->getConfigDir() . '/parameters.php', true);
        $parameters['app.public_dir'] = $bootstrap->getPublicDir();
        $parameters['app.root_dir'] = $bootstrap->getRootDir();
        $parameters['app.cache_dir'] = $bootstrap->getCacheDir();
        $parameters->setReadOnly();

        $processor = new Token($parameters, '%{', '}');
        $processor->process($config);

        $this->config = $config;

        $this->response = new Response();
        $this->container = $this->createContainer();
        #event.after.container

        $this->dispatcher = new Dispatcher($this->env, $this->config, $this->container);

    }

    /**
     * @return Container
     * @throws \Jadob\Container\Exception\ContainerException
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
        $container->add('event.listener', new EventListener());
        $container->add('logger', $this->logger);

        $container->registerProviders($services, $this->config);

        return $container;
    }

    /**
     * @return $this
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws Exception\DispatcherException
     * @throws \ReflectionException
     * @throws \Jadob\Container\Exception\ContainerException
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
     */
    public function execute()
    {
        #kernel.before.execute
        $this->response = $this->dispatcher->execute($this->container->get('request'));
        #kernel.after.execute

        return $this;
    }

    /**
     * Sends all output (response headers, cookies, content) to browser.
     */
    public function send()
    {
        $this->response->send();
    }

    /**
     * @throws \Exception
     */
    private function createLogger() {
        $this->logger = new Logger('error_log');
        $this->logger->pushHandler(new StreamHandler($this->bootstrap->getLogsDir().'/error.log'));
    }

    /**
     * @return Container
     */
    public function getContainer()
    {
        return $this->container;
    }
}

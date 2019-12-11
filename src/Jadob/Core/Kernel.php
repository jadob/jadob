<?php

declare(strict_types=1);

namespace Jadob\Core;

use Exception;
use Jadob\Bridge\Monolog\LoggerFactory;
use Jadob\Config\Config;
use Jadob\Container\Container;
use Jadob\Container\ContainerBuilder;
use Jadob\Container\ContainerEventListener;
use Jadob\Container\Exception\ContainerBuildException;
use Jadob\Container\Exception\ContainerException;
use Jadob\Container\Exception\ServiceNotFoundException;
use Jadob\Core\Event\AfterControllerEvent;
use Jadob\Core\Event\BeforeControllerEvent;
use Jadob\Core\Exception\KernelException;
use Jadob\Debug\ErrorHandler\HandlerFactory;
use Jadob\Debug\Profiler\Profiler;
use Jadob\EventDispatcher\EventDispatcher;
use Jadob\Router\Exception\RouteNotFoundException;
use Monolog\Handler\StreamHandler;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use ReflectionException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use function fastcgi_finish_request;
use function file_exists;
use function function_exists;
use function in_array;
use function is_array;

/**
 * Class Kernel
 * @package Jadob\Core
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class Kernel
{
    /**
     * semver formatted framework version
     * @see https://semver.org/
     * @var string
     */
    public const VERSION = '0.0.64';

    /**
     * If true, application log will be saved while destructing objects
     * @var bool
     */
    protected $deferLogs = false;

    /**
     * @var Config
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
     * @var EventDispatcher
     */
    protected $eventDispatcher;

    /**
     * @var ContainerBuilder
     */
    protected $containerBuilder;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * @var StreamHandler
     */
    protected $fileStreamHandler;

    /**
     * @var Profiler
     */
    protected $profiler;

    /**
     * @param string $env
     * @param BootstrapInterface $bootstrap
     * @throws KernelException
     * @throws Exception
     */
    public function __construct($env, BootstrapInterface $bootstrap, bool $deferLogs = false)
    {

        if (!in_array($env, ['dev', 'prod'], true)) {
            throw new KernelException('Invalid environment passed to application kernel (expected: dev|prod, ' . $env . ' given)');
        }

        $env = strtolower($env);
        $this->env = $env;
        $this->bootstrap = $bootstrap;
        $this->deferLogs = $deferLogs;
        $this->logger = $this->initializeLogger();

        $errorHandler = HandlerFactory::factory($env, $this->logger);
        $errorHandler->registerErrorHandler();
        $errorHandler->registerExceptionHandler();

        $this->eventDispatcher = new EventDispatcher();
        $this->config = (new Config())->loadDirectory($bootstrap->getConfigDir(), ['php']);
    }

    /**
     * @TODO: This one should be maybe more flexible (and shorter):
     * - this method should be called "handle" and it should need some basic stuff that can be extracted from superglobals
     * - handling HttpFoundation object should be realised via handleRequest(Request $request) which would be an alias for handle()
     *
     * @param Request $request
     * @return Response
     * @throws KernelException
     * @throws ContainerException
     * @throws ServiceNotFoundException
     * @throws RouteNotFoundException
     * @throws ReflectionException
     * @throws ContainerBuildException
     */
    public function execute(Request $request): Response
    {
        $requestId = substr(md5((string)mt_rand()), 0, 15);

        $this->logger->info('New request received', [
            'method' => $request->getMethod(),
            'path' => $request->getPathInfo(),
            'query' => $request->query->all(),
            'request_id' => $requestId
        ]);

        $builder = $this->getContainerBuilder();
        $builder->add('request', $request);

        $this->container = $builder->build($this->config->toArray());
        $this->container->addParameter('request_id', $requestId);

        $dispatcher = new Dispatcher($this->container);

        //@TODO this one should be moved  to dispather and called after router to provide matched route
        $beforeControllerEvent = new BeforeControllerEvent($request);

        $this->eventDispatcher->dispatch($beforeControllerEvent);

        $beforeControllerEventResponse = $beforeControllerEvent->getResponse();

        if ($beforeControllerEventResponse !== null) {
            $this->logger->debug('Received response from event listener, controller from route is not executed');
            return $beforeControllerEventResponse->prepare($request);
        }

        $response = $dispatcher->executeRequest($request);

        //@TODO: this one should be moved to dispatcher & should be called after controller
        $afterControllerEvent = new AfterControllerEvent($response);

        $this->eventDispatcher->dispatch($afterControllerEvent);

        if ($afterControllerEvent->getResponse() !== null) {
            return $afterControllerEvent->getResponse()->prepare($request);
        }

        return $response->prepare($request);
    }

    /**
     * @return Container
     */
    public function getContainer(): Container
    {
        return $this->container;
    }

    /**
     * @return string
     */
    public function getEnv(): string
    {
        return $this->env;
    }

    /**
     * @return ContainerBuilder
     * @throws KernelException
     */
    public function getContainerBuilder(): ContainerBuilder
    {
        if ($this->containerBuilder === null) {
            $servicesFile = $this->bootstrap->getConfigDir() . '/services.php';
            if (!file_exists($servicesFile)) {
                //TODO named exception constructors?
                throw new KernelException('There is no services.php file in your config dir.');
            }
            /** @var array $services */
            /** @noinspection PhpIncludeInspection */
            $services = include $servicesFile;

            if (!is_array($services)) {
                //TODO named exception constructors?
                throw new KernelException('services.php has missing return statement or returned value is not an array');
            }

            $listener = null;
            if ($this->env !== 'prod') {
                $listener = new ContainerEventListener();
            }
            $containerBuilder = new ContainerBuilder($listener);
            $containerBuilder->add(EventDispatcher::class, $this->eventDispatcher);
            $containerBuilder->add(BootstrapInterface::class, $this->bootstrap);
            $containerBuilder->add(__CLASS__, $this);
            $containerBuilder->add(LoggerInterface::class, $this->logger);
            $containerBuilder->add('logger.handler.default', $this->fileStreamHandler);
            $containerBuilder->setServiceProviders($this->bootstrap->getServiceProviders());
            $containerBuilder->add(Config::class, $this->config);

            foreach ($services as $serviceName => $serviceObject) {
                $containerBuilder->add($serviceName, $serviceObject);
            }

            $this->containerBuilder = $containerBuilder;
        }

        return $this->containerBuilder;
    }

    /**
     * @return Config
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Creates and preconfigures a monolog instance.
     * @return LoggerInterface
     * @throws Exception
     */
    protected function initializeLogger(): LoggerInterface
    {
        $logLevel = LogLevel::DEBUG;
        if ($this->env === 'prod') {
            $logLevel = LogLevel::INFO;
        }

        $this->fileStreamHandler = new StreamHandler(
            $this->bootstrap->getLogsDir() . '/' . $this->env . '.log',
            $logLevel
        );

        $factory = new LoggerFactory('app', $this->deferLogs);
        $factory->withHandler($this->fileStreamHandler);

        return $factory->create();
    }

    //@TODO: if prod, do not collect profiler data, disallow xdebug features if xdebug is not installed
    public function terminate(): void
    {
        if (function_exists('fastcgi_finish_request')) {
            fastcgi_finish_request();
        }

    }

}

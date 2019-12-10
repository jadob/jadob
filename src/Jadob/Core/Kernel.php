<?php

declare(strict_types=1);

namespace Jadob\Core;

use Jadob\Config\Config;
use Jadob\Container\Container;
use Jadob\Container\ContainerBuilder;
use Jadob\Core\Exception\KernelException;
use Jadob\Debug\ErrorHandler\HandlerFactory;
use Jadob\Debug\Profiler\Profiler;
use Jadob\Core\Event\AfterControllerEvent;
use Jadob\Core\Event\BeforeControllerEvent;
use Jadob\EventDispatcher\EventDispatcher;
use Jadob\EventListener\Event\Type\AfterControllerEventListenerInterface;
use Jadob\EventListener\Event\Type\BeforeControllerEventListenerInterface;
use Jadob\EventListener\EventListener;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
     * @deprecated
     * @var string
     */
    public const EXPERIMENTAL_FEATURES_ENV = 'JADOB_ENABLE_EXPERIMENTAL_FEATURES';

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
     * @deprecated to be replaced with eventDispatcher
     * @var EventListener
     */
    protected $eventListener;

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
     * @throws \Exception
     */
    public function __construct($env, BootstrapInterface $bootstrap)
    {

        if (!\in_array($env, ['dev', 'prod'], true)) {
            throw new KernelException('Invalid environment passed to application kernel (expected: dev|prod, ' . $env . ' given)');
        }

        $env = strtolower($env);
        $this->env = $env;
        $this->bootstrap = $bootstrap;
        $this->logger = $this->initializeLogger();

        //to be removed
        if (self::experimentalFeaturesEnabled()) {
            $this->logger->info('JADOB_ENABLE_EXPERIMENTAL_FEATURES flag exists. please double-test your app because new features may be unstable.');
        }

        $errorHandler = HandlerFactory::factory($env, $this->logger);
        $errorHandler->registerErrorHandler();
        $errorHandler->registerExceptionHandler();

        $this->eventListener = new EventListener($this->logger);
        $this->eventDispatcher = new EventDispatcher();

        $this->config = (new Config())->loadDirectory($bootstrap->getConfigDir(), ['php']);

        $this->addEvents();

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
     * @throws \ReflectionException
     * @throws ContainerBuildException
     */
    public function execute(Request $request): Response
    {
        $requestId = substr(md5((string)mt_rand()), 0, 15);

        $this->profiler = new Profiler($this->bootstrap->getCacheDir() . '/profiler', $requestId);
        $this->profiler->addEntry('JADOB_REQUEST_TIME', $request->server->get('REQUEST_TIME'));
        $this->logger->info('New request received', [
            'method' => $request->getMethod(),
            'path' => $request->getPathInfo(),
            'query' => $request->query->all(),
            'request_id' => $requestId
        ]);

        $builder = $this->getContainerBuilder();
        $builder->add('request', $request);
        $builder->add('profiler', $this->profiler);

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

        $this->eventListener->dispatchEvent($afterControllerEvent);

        if ($afterControllerEvent->getResponse() !== null) {
            return $afterControllerEvent->getResponse()->prepare($request);
        }

        return $response->prepare($request);
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
    public function isProduction(): bool
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

    //@TODO create Jadob/Core/EventDispatcherFactory and move all these things to new class
    protected function addEvents()
    {
        $this->eventListener->addEvent(
            BeforeControllerEvent::class,
            BeforeControllerEventListenerInterface::class,
            'onBeforeControllerEvent');

        $this->eventListener->addEvent(
            AfterControllerEvent::class,
            AfterControllerEventListenerInterface::class,
            'onAfterControllerEvent'
        );
    }

    /**
     * @return ContainerBuilder
     * @throws KernelException
     */
    public function getContainerBuilder(): ContainerBuilder
    {
        if ($this->containerBuilder === null) {
            /** @var array $services */
            $services = include $this->bootstrap->getConfigDir() . '/services.php';

            if (!\is_array($services)) {
                throw new KernelException('services.php has missing return statement or returned value is not an array');
            }
            $containerBuilder = new ContainerBuilder();
            $containerBuilder->add('event.listener', $this->eventListener);
            $containerBuilder->add(EventDispatcher::class, $this->eventDispatcher);
            $containerBuilder->add(BootstrapInterface::class, $this->bootstrap);
            $containerBuilder->add('kernel', $this);
            /** @TODO: how about creating an 'logger' service pointing to this.logger? */
            $containerBuilder->add(LoggerInterface::class, $this->logger);
            $containerBuilder->add('logger.handler.default', $this->fileStreamHandler);
            $containerBuilder->setServiceProviders($this->bootstrap->getServiceProviders());

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
     * @param array $config
     * @return Kernel
     * @deprecated probably
     */
    public function setConfig(array $config): Kernel
    {
        $this->config = $config;
        return $this;
    }

    /**
     * Creates and preconfigures a monolog instance.
     * @return Logger
     * @throws \Exception
     */
    public function initializeLogger()
    {
        $logger = new Logger('app');

        $logLevel = Logger::DEBUG;
        if ($this->env === 'prod') {
            $logLevel = Logger::INFO;
        }

        $this->fileStreamHandler = $fileStreamHandler = new StreamHandler(
            $this->bootstrap->getLogsDir() . '/' . $this->env . '.log',
            $logLevel
        );

        $logger->pushHandler($fileStreamHandler);

        return $logger;
    }

    /**
     * @deprecated
     * @return bool
     * @deprecated
     */
    public static function experimentalFeaturesEnabled(): bool
    {
        return (bool)getenv(self::EXPERIMENTAL_FEATURES_ENV);
    }

    //@TODO: if prod, do not collect profiler data, disallow xdebug features if xdebug is not installed
    public function terminate()
    {

//        r(xdebug_get_profiler_filename());
        $this->profiler->addEntry('JADOB_FINISH_TIME', microtime());
        $this->profiler->collectXDebugCoverage();
        $this->profiler->flush();
    }
}

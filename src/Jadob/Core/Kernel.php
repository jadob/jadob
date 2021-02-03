<?php

declare(strict_types=1);

namespace Jadob\Core;

use Exception;
use Jadob\Bridge\Monolog\LoggerFactory;
use Jadob\Config\Config;
use Jadob\Container\Container;
use Jadob\Container\ContainerBuilder;
use Jadob\Container\ContainerEventListener;
use Jadob\Container\Exception\AutowiringException;
use Jadob\Container\Exception\ContainerBuildException;
use Jadob\Container\Exception\ContainerException;
use Jadob\Container\Exception\ServiceNotFoundException;
use Jadob\Core\Exception\KernelException;
use Jadob\Core\Session\SessionHandlerFactory;
use Jadob\Debug\ErrorHandler\HandlerFactory;
use Jadob\EventDispatcher\EventDispatcher;
use Jadob\Router\Exception\MethodNotAllowedException;
use Jadob\Router\Exception\RouteNotFoundException;
use Jadob\Router\ServiceProvider\RouterServiceProvider;
use Monolog\Handler\StreamHandler;
use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use ReflectionException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use function array_merge;
use function fastcgi_finish_request;
use function file_exists;
use function function_exists;
use function in_array;
use function is_array;

/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class Kernel
{
    /**
     * semver formatted framework version
     *
     * @see https://semver.org/
     * @var string
     */
    public const VERSION = '0.1.5';

    /**
     * If true, application log will be saved while destructing objects
     *
     * @var bool
     */
    protected bool $deferLogs = false;

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
     * @var bool
     */
    protected bool $psr7Compliant = false;

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
     * @param Request $request
     * @param string|null $requestId ID of given request, which will be passed as a parameter to container and will be visible in all logs generated during these one request
     * @return Response
     * @throws AutowiringException
     * @throws ContainerBuildException
     * @throws ContainerException
     * @throws KernelException
     * @throws MethodNotAllowedException
     * @throws ReflectionException
     * @throws RouteNotFoundException
     * @throws ServiceNotFoundException
     */
    public function execute(Request $request, string $requestId = null): Response
    {
        /**
         * An unique ID for each given Request.
         * It can be useful during e.g. debugging.
         * You can override it with your own value.
         *
         * Example:
         * When your app is proxied via CloudFlare, you can pass CF-Request-ID header to match CF logs with application log.
         * When deployed to AWS Lambda, you can use Lambda Request ID to match both CloudWatch and application logs.
         */
        $requestId = $requestId ?? substr(md5((string)mt_rand()), 0, 15);

        $context = new RequestContext($requestId, $request, $this->psr7Compliant);

        $this->logger->info(
            'New request received', [
                'method' => $request->getMethod(),
                'path' => $request->getPathInfo(),
                'query' => $request->query->all(),
                'request_id' => $requestId
            ]
        );

        $builder = $this->getContainerBuilder();

        $configArray = $this->config->toArray();
        $this->container = $builder->build($configArray);

        /** @var SessionHandlerFactory $sessionHandlerFactory */
        $sessionHandlerFactory = $this->container->get(SessionHandlerFactory::class);
        $sessionHandler = $sessionHandlerFactory->create();
        $sessionStorage = new NativeSessionStorage([], $sessionHandler);
        $session = new Session($sessionStorage);


        $context->setSession($session);

        $dispatcherConfig = $configArray['framework']['dispatcher'];
        $dispatcher = new Dispatcher(
            $dispatcherConfig,
            $this->container,
            $this->logger,
            $this->eventDispatcher
        );

        $response = $dispatcher->executeRequest($context);

        return $this->prepareResponse($response, $request);
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
        /**
         * Providers for core features are added here, so you do not have to register them elsewhere in your bootstrap.
         * Also registering them here allow to validate configuration for core services.
         */
        $coreServiceProviders = [
            RouterServiceProvider::class
        ];

        //merge core & user provided services
        $serviceProviders = array_merge(
            $coreServiceProviders,
            $this->bootstrap->getServiceProviders($this->env)
        );


        if ($this->containerBuilder === null) {
            $servicesFile = $this->bootstrap->getConfigDir() . '/services.php';
            if (!file_exists($servicesFile)) {
                //TODO named exception constructors?
                throw new KernelException('There is no services.php file in your config directory.');
            }

            /** @var array $services */
            /** @noinspection PhpIncludeInspection */
            $services = include $servicesFile;

            if (!is_array($services)) {
                //TODO named exception constructors?
                throw new KernelException('services.php has missing return statement or returned value is not an array.');
            }

            $listener = null;
            if ($this->env !== 'prod') {
                $listener = new ContainerEventListener();
            }
            $containerBuilder = new ContainerBuilder($listener);
            //TODO: When service definitions and aliases will be ready, use them here
            $containerBuilder->add(EventDispatcherInterface::class, $this->eventDispatcher);
            $containerBuilder->add(BootstrapInterface::class, $this->bootstrap);
            $containerBuilder->add(__CLASS__, $this);
            $containerBuilder->add(LoggerInterface::class, $this->logger);
            $containerBuilder->add('logger.handler.default', $this->fileStreamHandler);
            $containerBuilder->setServiceProviders($serviceProviders);

            $containerBuilder->add(SessionHandlerFactory::class, static function (): SessionHandlerFactory {
                return new SessionHandlerFactory();
            });

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
     *
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

    public function setContainer(ContainerInterface $container): void
    {
        $this->container = $container;
    }


    /**
     * @param Response $response
     * @param Request $request
     * @return Response
     */
    public function prepareResponse(Response $response, Request $request): Response
    {
        /**
         * Pretty prints JSON Responses on dev environments.
         */
        if ($this->env !== 'prod' && $response instanceof JsonResponse) {
            $response->setEncodingOptions($response->getEncodingOptions() | JSON_PRETTY_PRINT);
        }

        /**
         * Applies some tweaks to Response object.
         */
        $response->prepare($request);

        return $response;
    }

    /**
     * @return bool
     */
    public function isPsr7Compliant(): bool
    {
        return $this->psr7Compliant;
    }

    /**
     * @param bool $psr7Compliant
     */
    public function setPsr7Compliant(bool $psr7Compliant): void
    {
        $this->psr7Compliant = $psr7Compliant;
    }
}

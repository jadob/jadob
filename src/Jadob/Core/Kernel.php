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
use Jadob\Core\Event\AfterControllerEvent;
use Jadob\Core\Event\BeforeControllerEvent;
use Jadob\Core\Exception\KernelException;
use Jadob\Debug\ErrorHandler\HandlerFactory;
use Jadob\EventDispatcher\EventDispatcher;
use Jadob\Router\Exception\MethodNotAllowedException;
use Jadob\Router\Exception\RouteNotFoundException;
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
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\NativeFileSessionHandler;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\HttpFoundation\Session\Storage\SessionStorageInterface;
use function fastcgi_finish_request;
use function file_exists;
use function function_exists;
use function in_array;
use function is_array;

/**
 * Class Kernel
 *
 * @package Jadob\Core
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
    public const VERSION = '0.0.65';

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
    protected bool $psr7Complaint = false;

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

        $context = new RequestContext($requestId, $request, $this->psr7Complaint);

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

        /**
         * @TODO: Allow session storage overloading
         */
        $session = new Session();

        $request->setSession($session);
        $context->setSession($session);
        $this->container->addParameter('request_id', $requestId);

        $dispatcherConfig = $configArray['framework']['dispatcher'];
        $dispatcher = new Dispatcher(
            $dispatcherConfig,
            $this->container,
            $this->logger,
            $this->eventDispatcher
        );

        $response = $dispatcher->executeRequest($context);

        //@TODO: this one should be moved to dispatcher & should be called after controller
        $afterControllerEvent = new AfterControllerEvent($response);

        $this->eventDispatcher->dispatch($afterControllerEvent);

        if ($afterControllerEvent->getResponse() !== null) {
            return $this->prepareResponse($afterControllerEvent->getResponse(), $request);
        }

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
            $containerBuilder->add(EventDispatcher::class, $this->eventDispatcher);
            $containerBuilder->add(BootstrapInterface::class, $this->bootstrap);
            $containerBuilder->add(__CLASS__, $this);
            $containerBuilder->add(LoggerInterface::class, $this->logger);
            $containerBuilder->add('logger.handler.default', $this->fileStreamHandler);
            $containerBuilder->setServiceProviders($this->bootstrap->getServiceProviders($this->env));
            $containerBuilder->add(Config::class, $this->config);

            /**
             * Split session to three services to allow handler overriding
             */
            $containerBuilder->add(\SessionHandlerInterface::class, new NativeFileSessionHandler());
            $containerBuilder->add(
                SessionStorageInterface::class,
                static function (Container $container): NativeSessionStorage {
                    return new NativeSessionStorage(
                        [],
                        $container->get(\SessionHandlerInterface::class)
                    );
                });

            $containerBuilder->add(
                SessionInterface::class,
                static function (Container $container): Session {
                    return new Session(
                        $container->get(SessionStorageInterface::class)
                    );
                }
            );

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
    public function isPsr7Complaint(): bool
    {
        return $this->psr7Complaint;
    }

    /**
     * @param bool $psr7Complaint
     */
    public function setPsr7Complaint(bool $psr7Complaint): void
    {
        $this->psr7Complaint = $psr7Complaint;
    }
}

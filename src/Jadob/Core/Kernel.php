<?php

declare(strict_types=1);

namespace Jadob\Core;

use Exception;
use Jadob\Config\Config;
use Jadob\Container\Container;
use Jadob\Container\ContainerBuilder;
use Jadob\Container\ContainerEventListener;
use Jadob\Container\Exception\AutowiringException;
use Jadob\Container\Exception\ContainerBuildException;
use Jadob\Container\Exception\ContainerException;
use Jadob\Container\Exception\ServiceNotFoundException;
use Jadob\Contracts\ErrorHandler\ErrorHandlerInterface;
use Jadob\Contracts\EventDispatcher\EventDispatcherInterface;
use Jadob\Core\Exception\KernelException;
use Jadob\Core\Session\SessionHandlerFactory;
use Jadob\Debug\ErrorHandler\HandlerFactory;
use Jadob\Framework\Logger\LoggerFactory;
use Jadob\Router\Exception\MethodNotAllowedException;
use Jadob\Router\Exception\RouteNotFoundException;
use Jadob\Runtime\RuntimeFactory;
use Jadob\Runtime\RuntimeInterface;
use LogicException;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;
use ReflectionException;
use RuntimeException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\SessionStorageInterface;

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
    public const VERSION = '0.7.1';

    protected RuntimeInterface $runtime;

    protected RequestContextStore $contextStore;

    public function __construct(
        protected string   $env,
        private BootstrapInterface $bootstrap,
        private Container $container,
        private EventDispatcherInterface $eventDispatcher,
        private ErrorHandlerInterface $errorHandler,
        private LoggerFactory $loggerFactory,
    )
    {
        if (!in_array($env, ['dev', 'prod'], true)) {
            throw new KernelException('Invalid environment passed to application kernel (expected: dev|prod, ' . $env . ' given)');
        }

        $this->runtime = RuntimeFactory::fromGlobals();
        $this->bootstrap = $this->wrapBootstrapClass($bootstrap, $this->runtime);

        $errorHandler->registerErrorHandler();
        $errorHandler->registerExceptionHandler();

        $this->contextStore = new RequestContextStore();
    }


    private function wrapBootstrapClass(BootstrapInterface $bootstrap, RuntimeInterface $runtime): BootstrapInterface
    {
        $runtimeTmpDir = $runtime->getTmpDir();

        if ($runtimeTmpDir === null) {
            return $bootstrap;
        }

        return new WrappedBootstrap($bootstrap, $runtimeTmpDir);
    }

    /**
     * @param Request $request
     * @param string|null $requestId ID of given request, which will be passed as a parameter to container and will be visible in all logs generated during these one request
     * @return Response
     * @throws ContainerException
     * @throws KernelException
     * @throws MethodNotAllowedException
     * @throws ReflectionException
     * @throws RouteNotFoundException
     * @throws ServiceNotFoundException
     */
    public function execute(Request $request, ?string $requestId = null): Response
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

        $context = new RequestContext($requestId, $request);

//        $this->logger->info(
//            'New request received', [
//                'method' => $request->getMethod(),
//                'path' => $request->getPathInfo(),
//                'query' => $request->query->all(),
//                'request_id' => $requestId
//            ]
//        );

        /** @var SessionStorageInterface $sessionStorage */
        $sessionStorage = $this->container->get(SessionStorageInterface::class);
        $session = new Session($sessionStorage);
        $context->setSession($session);
        $this->contextStore->push($context);

        /** @var LoggerFactory $loggerFactory */
        $loggerFactory =  $this->container->get(LoggerFactory::class);

        $dispatcher = new Dispatcher(
            $this->container,
            $loggerFactory->getLoggerForChannel('dispatcher'),
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


        if ($this->containerBuilder === null) {


            if (!is_array($services)) {
                //TODO named exception constructors?
                throw new KernelException('services.php has missing return statement or returned value is not an array.');
            }

            $listener = null;
            if ($this->env !== 'prod') {
                $listener = new ContainerEventListener();
            }
            $containerBuilder = new ContainerBuilder($listener);

            $containerBuilder->add(BootstrapInterface::class, $this->bootstrap);
            $containerBuilder->add(__CLASS__, $this);
            $containerBuilder->add(LoggerInterface::class, $this->logger);
            $containerBuilder->add('logger.handler.default', $this->fileStreamHandler);
            $containerBuilder->add(RuntimeInterface::class, $this->runtime);
            $containerBuilder->add(RequestContextStore::class, $this->contextStore);
            $containerBuilder->setServiceProviders($serviceProviders);

            $containerBuilder->add(SessionHandlerFactory::class, static function (): SessionHandlerFactory {
                return new SessionHandlerFactory();
            });

            foreach ($services as $serviceName => $serviceObject) {
                if (!is_string($serviceName) || !(is_array($serviceObject) || is_object($serviceObject))) {
                    throw new RuntimeException(
                        'There is an malformed entry in services.php as there is neither string as a key nor array|object in value'
                    );
                }
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
     * @deprecated
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
            $this->bootstrap->getDefaultLogStream($this->env),
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

    /**
     * @param string[] $envsToCheck
     */
    public static function checkEnvsPresence(array $envsToCheck): void
    {
        foreach ($envsToCheck as $variable) {
            if (!isset($_ENV[$variable])) {
                throw new LogicException(sprintf('Missing "%s" env.', $variable));
            }
        }
    }

    /**
     * If your app relies on some extension (e.g, oci8, amqp), call this method before Kernel class instantiation
     * to ensure that given extensions are installed. If not, execution will be stopped.
     * @param string[] $extsToCheck
     */
    public static function checkExtensionsPresence(array $extsToCheck): void
    {
        foreach ($extsToCheck as $variable) {
            if (!extension_loaded($variable)) {
                throw new RuntimeException(sprintf('Missing "%s" extension.', $variable));
            }
        }
    }
}

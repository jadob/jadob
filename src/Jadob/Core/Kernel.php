<?php

declare(strict_types=1);

namespace Jadob\Core;

use Jadob\Container\Exception\ContainerException;
use Jadob\Container\Exception\ServiceNotFoundException;
use Jadob\Contracts\ErrorHandler\ErrorHandlerInterface;
use Jadob\Core\Exception\KernelException;
use Jadob\Framework\Logger\LoggerFactory;
use Jadob\Router\Exception\MethodNotAllowedException;
use Jadob\Router\Exception\RouteNotFoundException;
use Jadob\Runtime\RuntimeFactory;
use Jadob\Runtime\RuntimeInterface;
use LogicException;
use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use ReflectionException;
use RuntimeException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\SessionStorageInterface;

use function fastcgi_finish_request;
use function function_exists;
use function in_array;
use function is_array;

/**
 * @deprecated
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
    public const VERSION = '0.9.2';

    protected RuntimeInterface $runtime;

    protected RequestContextStore $contextStore;

    public function __construct(
        protected string $env,
        private BootstrapInterface $bootstrap,
        private ContainerInterface $container,
        private EventDispatcherInterface $eventDispatcher,
        private ErrorHandlerInterface $errorHandler,
        private LoggerFactory $loggerFactory,
    ) {
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
        $requestId = $requestId ?? substr(md5((string) mt_rand()), 0, 15);

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
     * @return string
     */
    public function getEnv(): string
    {
        return $this->env;
    }

    //@TODO: if prod, do not collect profiler data, disallow xdebug features if xdebug is not installed
    public function terminate(): void
    {
        if (function_exists('fastcgi_finish_request')) {
            fastcgi_finish_request();
        }
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

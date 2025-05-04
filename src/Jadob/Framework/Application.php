<?php
declare(strict_types=1);

namespace Jadob\Framework;

use Jadob\Config\Config;
use Jadob\Container\Container;
use Jadob\Container\ParameterStore;
use Jadob\Contracts\EventDispatcher\EventDispatcherInterface;
use Jadob\Core\BootstrapInterface;
use Jadob\Core\Dispatcher;
use Jadob\Core\Exception\KernelException;
use Jadob\Core\RequestContext;
use Jadob\Core\RequestContextStore;
use Jadob\EventDispatcher\EventDispatcher;
use Jadob\Framework\ErrorHandler\ExceptionHandler;
use Jadob\Framework\ErrorHandler\ExceptionListenerFactory;
use Jadob\Framework\ErrorHandler\ExceptionListenerInterface;
use Jadob\Framework\Logger\LoggerFactory;
use Jadob\Router\Router;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Application as CliApplication;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\SessionStorageInterface;
use function array_merge;

readonly class Application
{
    private ExceptionHandler $exceptionHandler;
    private ExceptionListenerInterface $fallbackExceptionListener;
    private Container $container;
    private RequestContextStore $requestContextStore;

    public function __construct(
        private string             $env,
        private BootstrapInterface $bootstrap,
        private array              $serviceProviders,
        private array              $modules
    ) {
        $this->requestContextStore = new RequestContextStore();
        $this->exceptionHandler = new ExceptionHandler(
            $this->fallbackExceptionListener = ExceptionListenerFactory::createForEnv($this->env)
        );
    }

    private function build(): void
    {
        $this->exceptionHandler->registerErrorHandler();
        $this->exceptionHandler->registerExceptionHandler();

        $servicesFile = $this->bootstrap->getConfigDir() . '/services.php';
        if (!file_exists($servicesFile)) {
            //TODO named exception constructors?
            throw new KernelException('There is no services.php file in your config directory.');
        }

        /** @var array $services */
        $services = include $servicesFile;


        $modules = array_merge(
            $this->bootstrap->getModules(),
            $this->modules
        );

        $serviceProviders = array_merge(
            $this->bootstrap->getServiceProviders($this->env),
            $this->serviceProviders
        );

        $config = (new Config())->loadDirectory($this->bootstrap->getConfigDir(), ['php']);
        $parameterNode = [];
        if ($config->hasNode('parameters')) {
            $parameterNode = $config->getNode('parameters');
        }

        $container = new Container();
        $container->add(BootstrapInterface::class, $this->bootstrap);
        $container->add(RequestContextStore::class, $this->requestContextStore);
        $container->add(ParameterStore::class, new ParameterStore(
            array_merge(
                $parameterNode,
                [
                    'app_env' => $this->env,
                    'root_dir' => $this->bootstrap->getRootDir(),
                    'cache_dir' => $this->bootstrap->getCacheDir(),
                    'env_cache_dir' => sprintf(
                        '%s/%s',
                        $this->bootstrap->getCacheDir(),
                        $this->env
                    ),
                ]
            )
        ));

        foreach ($modules as $module) {
            foreach ($module->getServiceProviders($this->env) as $serviceProvider) {
                $container->registerServiceProvider($serviceProvider);
            }

            foreach ($module->getContainerExtensionProviders($this->env) as $extensionProvider) {
                foreach ($extensionProvider->getContainerExtensions() as $extension) {
                    $container->addExtension($extension);
                }
            }
        }

        foreach ($serviceProviders as $serviceProvider) {
            $container->registerServiceProvider($serviceProvider);
        }

        foreach ($services as $coreServiceId => $coreService) {
            $container->add($coreServiceId, $coreService);
        }

        $container->build($config->toArray());
        $container->add(LoggerInterface::class, $container->get(LoggerFactory::class)->getDefaultLogger());
        /** @var EventDispatcher $eventDispatcher */
        $eventDispatcher = $container->get(EventDispatcherInterface::class);
        foreach ($modules as $module) {
            foreach ($module->getContainerExtensionProviders($this->env) as $containerExtensionProvider) {
                foreach ($containerExtensionProvider->getAutowiringExtensions($container) as $extension) {
                    $container->addAutowiringExtension($extension);
                }
            }

            foreach ($module->getEventListeners($container, $this->env) as $listener) {
                $eventDispatcher->addListener($listener);
            }
        }

        $this->container = $container;

        if ($this->fallbackExceptionListener instanceof LoggerAwareInterface) {
            $this->fallbackExceptionListener
                ->setLogger(
                    $this->getLoggerFactory()->getDefaultErrorLogger()
                );
        }
    }

    public function handleWebRequest(Request $request): Response
    {
        try {
            $this->build();
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

            /** @var SessionStorageInterface $sessionStorage */
            $sessionStorage = $this->container->get(SessionStorageInterface::class);
            $session = new Session($sessionStorage);
            $context->setSession($session);
            $this->requestContextStore->push($context);

            /** @var LoggerFactory $loggerFactory */
            $loggerFactory = $this->container->get(LoggerFactory::class);

            $dispatcher = new Dispatcher(
                $this->container,
                $loggerFactory->getLoggerForChannel('dispatcher'),
                $this->container->get(EventDispatcherInterface::class)
            );

            $response = $dispatcher->executeRequest($context);

            return $response;
        } catch (\Throwable $exception) {
            return $this
                ->exceptionHandler
                ->handleException($exception);
        }
    }


    private function getLoggerFactory(): LoggerFactory
    {
        return $this->container->get(LoggerFactory::class);
    }

    private function getRouter(): Router
    {
        return $this->container->get(Router::class);
    }

    public function terminate(): void
    {
        if (function_exists('fastcgi_finish_request')) {
            fastcgi_finish_request();
        }
    }

    public function getConsole(): CliApplication
    {
        return $this->container->get(CliApplication::class);
    }
}
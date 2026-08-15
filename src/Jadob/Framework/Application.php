<?php
declare(strict_types=1);

namespace Jadob\Framework;

use Jadob\Container\Builder\ContainerBuilder;
use Jadob\Container\Compiler\ContainerCompiler;
use Jadob\Container\Config\ConfigNodeFinder;
use Jadob\Container\ServiceGraphContainer;
use Jadob\Container\ParameterStore;
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
use Psr\Container\ContainerInterface;
use Psr\EventDispatcher\EventDispatcherInterface;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Application as CliApplication;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\SessionStorageInterface;
use Throwable;
use function array_merge;
use function get_class;
use function Symfony\Component\String\b;

readonly class Application
{
    private ExceptionHandler $exceptionHandler;
    private ExceptionListenerInterface $fallbackExceptionListener;
    private ContainerInterface $container;
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

        $modules = array_merge(
            $this->bootstrap->getModules(),
            $this->modules
        );

        $serviceProviders = array_merge(
            $this->bootstrap->getServiceProviders($this->env),
            $this->serviceProviders
        );

        $configDir = $this
            ->bootstrap
            ->getConfigDir();

        /** @var \Closure $userspaceContainerConfig */
        $userspaceContainerConfig = include $servicesFile;

        $builder = new ContainerBuilder();

        $bootstrapFileFqcn = get_class($this->bootstrap);
        $builder
            ->set($bootstrapFileFqcn)
            ->withFactory(fn (): BootstrapInterface => $this->bootstrap);

        $builder->bind(
            BootstrapInterface::class,
            $bootstrapFileFqcn
        );

        $builder->loadConfiguration($userspaceContainerConfig);
        foreach ($modules as $module) {
            foreach ($module->getServiceProviders($this->env) as $serviceProvider) {
                $serviceProviders[] = $serviceProvider;
            }

//            foreach ($module->getContainerExtensionProviders($this->env) as $extensionProvider) {
//                foreach ($extensionProvider->getContainerExtensions() as $extension) {
//                    $container->addExtension($extension);
//                }
//            }
        }

        foreach ($serviceProviders as $serviceProvider) {
            $builder->registerServiceProvider($serviceProvider);
        }

        $configLocations = [
            $this->bootstrap->getConfigDir(), // base configs
            sprintf('%s/%s/', $configDir, $this->env), // environment overrides
            sprintf('%s/local/', $configDir), // local overrides
        ];

        $compiler = new ContainerCompiler(
            new ConfigNodeFinder($configLocations)
        );

        $compiler->registerNativeExtensions();

        foreach ($modules as $module) {
            foreach ($module->getContainerCompilerExtensions() as $priority => $extension) {
                $compiler->addExtension(
                    extension: $extension,
                    id: get_class($extension),
                    priority: $priority,
                );
            }
        }


        $container = new ServiceGraphContainer(
            $compiler->compile($builder)
        );


    }

    public function handleWebRequest(
        Request $request,
        ?string $requestId = null,
    ): Response
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
            $requestId = $requestId ?? substr(md5((string) mt_rand()), 0, 15);

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
        } catch (Throwable $exception) {
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
        $this->build();
        return $this->container->get(CliApplication::class);
    }
}
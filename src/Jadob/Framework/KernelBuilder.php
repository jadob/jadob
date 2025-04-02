<?php

namespace Jadob\Framework;

use Jadob\Config\Config;
use Jadob\Container\Container;
use Jadob\Contracts\ErrorHandler\ErrorHandlerInterface;
use Jadob\Contracts\EventDispatcher\EventDispatcherInterface;
use Jadob\Core\BootstrapInterface;
use Jadob\Core\Exception\KernelException;
use Jadob\Core\Kernel;
use Jadob\Core\RequestContextStore;
use Jadob\Framework\Logger\LoggerFactory;

class KernelBuilder
{

    private BootstrapInterface $bootstrap;

    public function withBootstrap(BootstrapInterface $bootstrap): self
    {
        $this->bootstrap = $bootstrap;
        return $this;
    }


    public function build(string $env): Kernel
    {
        $config = (new Config())->loadDirectory($this->bootstrap->getConfigDir(), ['php']);

        $servicesFile = $this->bootstrap->getConfigDir() . '/services.php';
        if (!file_exists($servicesFile)) {
            //TODO named exception constructors?
            throw new KernelException('There is no services.php file in your config directory.');
        }

        /** @var array $services */
        $services = include $servicesFile;

        $serviceProviders = $this->bootstrap->getServiceProviders($env);
        $modules = $this->bootstrap->getModules();

        $container = new Container();
        $container->add(BootstrapInterface::class, $this->bootstrap);
        $container->add(RequestContextStore::class, new RequestContextStore());

        foreach ($services as $coreServiceId => $coreService) {
            $container->add($coreServiceId, $coreService);
        }

        foreach ($serviceProviders as $serviceProvider) {
            $container->registerServiceProvider($serviceProvider);
        }

        foreach ($modules as $module) {
            foreach ($module->getServiceProviders($env) as $serviceProvider) {
                $container->registerServiceProvider($serviceProvider);
            }
        }

        $container->resolveServiceProviders($config->toArray());

        foreach ($modules as $module) {
            foreach ($module->getContainerExtensionProviders($env) as $containerExtensionProvider) {
                foreach ($containerExtensionProvider->getAutowiringExtensions($container) as $extension) {
                    $container->addAutowiringExtension($extension);
                }
            }
        }

        return new Kernel(
            env: $env,
            bootstrap: $this->bootstrap,
            container: $container,
            eventDispatcher: $container->get(EventDispatcherInterface::class),
            errorHandler: $container->get(ErrorHandlerInterface::class),
            loggerFactory: $container->get(LoggerFactory::class)
        );
    }
}
<?php

namespace Jadob\Framework\ServiceProvider;


use Jadob\Container\ParameterStore;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Jadob\Core\BootstrapInterface;
use ProxyManager\Configuration;
use ProxyManager\Factory\LazyLoadingValueHolderFactory;
use ProxyManager\FileLocator\FileLocator;
use ProxyManager\GeneratorStrategy\FileWriterGeneratorStrategy;
use Psr\Container\ContainerInterface;

class ProxyManagerProvider implements ServiceProviderInterface
{

    public function getConfigNode(): ?string
    {
        return null;
    }

    public function register(ContainerInterface $container, object|array|null $config = null): array
    {
        return [LazyLoadingValueHolderFactory::class => function (
            BootstrapInterface $bootstrap,
            ParameterStore     $parameterStore, //@TODO: when passing parameters will be available, use it here to get env
        ) {

            $cacheDir = $bootstrap->getCacheDir();
            $proxyManagerConfig = new Configuration();
            $proxyManagerCacheDir = sprintf(
                '%s/%s',
                $cacheDir,
                $parameterStore->get('app_env')
            );

            $this->ensureCacheDirCreated($proxyManagerCacheDir);
            $proxyManagerFileLocator = new FileLocator(
                $proxyManagerCacheDir,
            );

            $proxyManagerConfig->setGeneratorStrategy(
                new FileWriterGeneratorStrategy(
                    $proxyManagerFileLocator
                )
            );

            $proxyManagerConfig->setProxiesTargetDir($proxyManagerCacheDir);
            spl_autoload_register($proxyManagerConfig->getProxyAutoloader());


            return new LazyLoadingValueHolderFactory(
                $proxyManagerConfig
            );
        }];
    }


    private function ensureCacheDirCreated(string $cacheDir): void
    {
        if (!file_exists($cacheDir)) {
            \mkdir(
                $cacheDir,
                recursive: true
            );
        }
    }
}
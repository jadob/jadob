<?php

namespace Jadob\Container;

use Jadob\Config\Config;
use Jadob\Container\Exception\ContainerBuildException;
use Jadob\Container\Exception\ContainerException;
use Jadob\Container\ServiceProvider\ParentProviderInterface;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;

/**
 * Class ContainerBuilder
 * @package Jadob\Container
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class ContainerBuilder
{
    /**
     * @var array
     */
    protected $services = [];

    /**
     * @var array
     */
    protected $factories = [];


    protected $registeredProviders = [];

    /**
     * @var ServiceProviderInterface[]
     */
    protected $instantiatedProviders = [];

    /**
     * @var string[]
     */
    protected $serviceProviders = [];

    /**
     * @param string $serviceName
     * @param mixed $definition
     * @return $this
     */
    public function add($serviceName, $definition): self
    {
        if ($definition instanceof \Closure) {
            $this->factories[$serviceName] = $definition;
            return $this;
        }

        $this->services[$serviceName] = $definition;
        return $this;
    }

    /**
     * @param array $config
     * @return Container
     * @throws ContainerException
     * @throws ContainerBuildException
     */
    public function build(array $config = []): Container
    {
        foreach ($this->serviceProviders as $serviceProvider) {
            $provider = $this->instantiateProvider($serviceProvider);

            /**
             * If current provider relies on others, it possible to define them by implementing an interface to them.
             * Then, parent classes will be registered before the current one
             */
            if ($provider instanceof ParentProviderInterface) {
                foreach ($provider->getParentProviders() as $parentProvider) {
                    $this->registerProvider($parentProvider, $config);
                }
            }

            $this->registerProvider($provider, $config);
        }


        $container = new Container($this->services, $this->factories);

        foreach ($this->serviceProviders as $serviceProvider) {
            $provider = new $serviceProvider;

            if (!($provider instanceof ServiceProviderInterface)) {
                throw new ContainerException('Class ' . $serviceProvider . ' cannot be used as an service provider');
            }

            $configNodeKey = $provider->getConfigNode();
            $configNode = $this->getConfigNode($config, $configNodeKey);
            $provider->onContainerBuild($container, $configNode);

        }

        return $container;
    }

    /**
     * @param Config|null $config
     * @param string $configNodeKey
     * @return array|null
     *
     * @throws ContainerException
     */
    protected function getConfigNode(array $config, $configNodeKey): array
    {
        //TODO: Refactor
        if ($configNodeKey !== null && !$config->hasNode($configNodeKey)) {
            throw new ContainerException('Could not find config node named "' . $configNodeKey . '"');
        }

        //if provider does not needs any config, we can pass null then
        if ($configNodeKey === null) {
            return null;
        }

        return $config->getNode($configNodeKey);
    }

    /**
     * @return array
     */
    public function getServiceProviders(): array
    {
        return $this->serviceProviders;
    }

    /**
     * @param ServiceProviderInterface[] $serviceProviders
     * @return ContainerBuilder
     */
    public function setServiceProviders(array $serviceProviders): ContainerBuilder
    {
        $this->serviceProviders = $serviceProviders;
        return $this;
    }

    /**
     * @return array
     */
    public function getServices(): array
    {
        return $this->services;
    }


    /**
     * @return array
     */
    public function getFactories(): array
    {
        return $this->factories;
    }

    /**
     * {@inheritdoc}
     */
    public function has($id): bool
    {
        return isset($this->services[$id]) || isset($this->factories[$id]);
    }


    /**
     * @param string $providerClass
     * @return ServiceProviderInterface
     * @throws ContainerBuildException
     */
    private function instantiateProvider(string $providerClass): ServiceProviderInterface
    {
        $provider = new $providerClass();

        if (!($provider instanceof ServiceProviderInterface)) {
            throw new ContainerBuildException('Class ' . $providerClass . ' cannot be used as an service provider');
        }

        $this->instantiatedProviders[$providerClass] = $provider;

        return $provider;
    }

    private function registerProvider(ServiceProviderInterface $provider, array $config = []): void
    {
        $configNodeKey = $provider->getConfigNode();
        $configNode = $this->getConfigNode($config, $configNodeKey);

        $results = $provider->register($configNode);

        if (\is_array($results)) {
            foreach ($results as $serviceKey => $service) {

                if ($service instanceof \Closure) {
                    $this->factories[$serviceKey] = $service;
                } else {
                    $this->services[$serviceKey] = $service;
                }
            }
        }
    }
}
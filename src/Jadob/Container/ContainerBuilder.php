<?php

namespace Jadob\Container;

use Jadob\Container\Exception\ContainerBuildException;
use Jadob\Container\Exception\ContainerException;
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

    /**
     * @var array
     */
    protected $serviceProviders = [];

    /**
     * @param string $serviceName
     * @param mixed $definition
     * @return $this
     */
    public function add($serviceName, $definition)
    {
        if ($definition instanceof \Closure) {
            $this->factories[$serviceName] = $definition;
            return $this;
        }

        $this->services[$serviceName] = $definition;
        return $this;
    }

    /**
     * @return Container
     * @throws ContainerException
     * @throws ContainerBuildException
     */
    public function build($config)
    {

        if (!\is_array($config)) {
            throw new ContainerBuildException('Config should be an array, ' . \gettype($config) . ' passed');
        }

        return $this->buildContainer($config);
    }

    /**
     * @deprecated
     * @param array $config framework configuration
     * @return $this
     * @throws ContainerException
     */
    public function registerServiceProviders(array $config)
    {

        foreach ($this->serviceProviders as $serviceProvider) {
            /** @var ServiceProviderInterface $provider */
            $provider = new $serviceProvider;

            if (!($provider instanceof ServiceProviderInterface)) {
                throw new ContainerException('Class ' . $serviceProvider . ' cannot be used as an service provider');
            }

            $configNodeKey = $provider->getConfigNode();
            $configNode = $this->getConfigNode($config, $configNodeKey);


            $provider->register($configNode);
        }

        return $this;
    }


    /**
     * @param $config
     * @return Container
     * @throws ContainerException
     */
    protected function buildContainer($config)
    {
        $services = [];

        foreach ($this->serviceProviders as $serviceProvider) {
            $provider = new $serviceProvider();

            if (!($provider instanceof ServiceProviderInterface)) {
                throw new ContainerException('Class ' . $serviceProvider . ' cannot be used as an service provider');
            }

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
     * @param mixed[] $config
     * @param string $configNodeKey
     * @return array|null
     *
     * @throws ContainerException
     */
    protected function getConfigNode($config, $configNodeKey)
    {
        if ($configNodeKey !== null && !isset($config[$configNodeKey])) {
            throw new ContainerException('Could not find config node named ' . $configNodeKey);
        }

        return $config[$configNodeKey] ?? null;
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
     * @param array $services
     * @return ContainerBuilder
     */
    public function setServices(array $services): ContainerBuilder
    {
        $this->services = $services;
        return $this;
    }

    /**
     * @return array
     */
    public function getFactories(): array
    {
        return $this->factories;
    }

    /**
     * @param array $factories
     * @return ContainerBuilder
     */
    public function setFactories(array $factories): ContainerBuilder
    {
        $this->factories = $factories;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function has($id)
    {
        return isset($this->services[$id]) || isset($this->factories[$id]);
    }
}
<?php

namespace Jadob\Container;

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
     * @TODO:
     * @return Container
     * @throws ContainerException
     */
    public function build($config)
    {
        $this->registerServiceProviders($config);

        return $this->buildContainer($config);
    }

    /**
     * @param array $config framework configuration
     * @return $this
     * @throws ContainerException
     */
    public function registerServiceProviders(array $config)
    {

        foreach ($this->serviceProviders as $serviceProvider) {
            $provider = new $serviceProvider;

            if (!($provider instanceof ServiceProviderInterface)) {
                throw new ContainerException('Class ' . $serviceProvider . ' cannot be used as an service provider');
            }

            $configNodeKey = $provider->getConfigNode();
            $configNode = $this->getConfigNode($config, $configNodeKey);

            $provider->register($this, $configNode);
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

}
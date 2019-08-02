<?php

namespace Jadob\Container;

use Jadob\Config\Config;
use Jadob\Container\Exception\ContainerBuildException;
use Jadob\Container\Exception\ContainerException;
use Jadob\Container\ServiceProvider\ConfigSchemaValidatorProviderInterface;
use Jadob\Container\ServiceProvider\DefaultConfigProviderInterface;
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
     * @var ServiceProviderInterface[]
     */
    protected $registeredProviders = [];

    /**
     * @var string[]
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
    public function build(Config $config)
    {
        return $this->buildContainer($config);
    }

    /**
     * @param $config
     * @return Container
     * @throws ContainerException
     */
    protected function buildContainer(?Config $config = null, $validateConfigNodes = true)
    {
        //create empty config object
        if ($config === null) {
            $config = new Config();
        }

        foreach ($this->serviceProviders as $serviceProvider) {
            $provider = new $serviceProvider();

            if (!($provider instanceof ServiceProviderInterface)) {
                throw new ContainerException('Class ' . $serviceProvider . ' cannot be used as an service provider');
            }

            $configNodeKey = $provider->getConfigNode();
            $configNode = $this->getConfigNode($config, $configNodeKey);

            if (
                $configNodeKey !== null
                && $provider instanceof ConfigSchemaValidatorProviderInterface
            ) {
                $configToValidate = [];

                if ($provider instanceof DefaultConfigProviderInterface) {
                    $configToValidate = \array_merge($provider->getDefaultConfig(), $configNode);
                }

                //@TODO: validate config node here

            }

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
     * @param Config|null $config
     * @param string $configNodeKey
     * @return array|null
     *
     * @throws ContainerException
     */
    protected function getConfigNode(Config $config, $configNodeKey)
    {
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
     * @deprecated
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
     * @deprecated
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


    /**
     * @param string $provider
     * @return ServiceProviderInterface
     * @throws ContainerException
     */
    private function instantiateProvider(string $providerClass): ServiceProviderInterface
    {
        $provider = new $providerClass();

        if (!($provider instanceof ServiceProviderInterface)) {
            throw new ContainerException('Class ' . $provider . ' cannot be used as an service provider');
        }
    }
}
<?php

namespace Jadob\Container;

use Jadob\Container\Definition\DefinitionBuilder;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Psr\Container\ContainerInterface;
use Jadob\Container\Exception\ContainerException;
use Jadob\Container\Exception\ServiceNotFoundException;

/**
 * Class Container
 * @package Jadob\Container
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 * @see http://www.php-fig.org/psr/psr-11/
 */
class Container implements ContainerInterface
{

    /**
     * Instantiated or manually added services.
     * @var array
     */
    private $container = [];

    /**
     * Service definitions
     * @var array
     */
    protected $definitions = [];

    /**
     * @var DefinitionBuilder
     */
    protected $definitionBuilder;


    /**
     * @param $id
     * @param $object
     * @return $this
     * @internal param $key
     */
    public function add($id, $object)
    {
        $this->container[$id] = $object;

        return $this;
    }

    /**
     * @param Definition $definition
     * @return $this
     */
    public function addDefinition(Definition $definition)
    {
        $this->definitions[$definition->getServiceName()] = $definition;
        return $this;
    }

    /**
     * {@inheritdoc}
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
     */
    public function get($id)
    {
        if (isset($this->container[$id])) {
            return $this->container[$id];
        }

        if (isset($this->definitions[$id])) {
            /** @var Definition $definition */
            $definition = $this->definitions[$id];
            $dependency = $this->getDefinitionBuilder()->buildDependencyFromDefinition($definition);

            $this->container[$id] = $dependency;

            return $dependency;
        }

        throw new ServiceNotFoundException('Service "' . $id . '" is not registered.');
    }

    /**
     * {@inheritdoc}
     */
    public function has($id)
    {
        return isset($this->container[$id]);
    }

    /**
     * Search for class defined in $className and returns it. otherwise null returned.
     * @param $className
     * @return null|mixed
     * @throws \RuntimeException
     */
    public function findServiceByClassName($className)
    {
        foreach ($this->container as $key => $service) {
            if (\get_class($service) === $className) {
                return $service;
            }
        }

        throw new \RuntimeException('Class ' . $className . ' is not registered in container');
    }

    /**
     * @param array $providers
     * @param array $configuration
     * @throws ContainerException
     */
    public function registerProviders(array $providers, array $configuration)
    {
        foreach ($providers as $service) {

            /**
             * We need to check it before we create the class
             */
            if (!\in_array(ServiceProviderInterface::class, \class_implements($service), true)) {
                throw new ContainerException('Class ' . $service . ' cannot be used as a service provider as it is not implements ' . ServiceProviderInterface::class);
            }

            /** @var \Jadob\Container\ServiceProvider\ServiceProviderInterface $provider * */
            $provider = new $service;

            $configNode = $provider->getConfigNode();

            if ($configNode !== null && !array_key_exists($configNode, $configuration)) {
                throw new ContainerException('Config node "' . $configNode . '" requested by ' . $service . ' does not exists.');
            }

            $config = null;

            if ($configNode !== null) {
                $config = $configuration[$configNode];
            }

            $provider->register($this, $config);
        }
    }

    /**
     * @return DefinitionBuilder
     */
    protected function getDefinitionBuilder()
    {
        if ($this->definitionBuilder === null) {
            $this->definitionBuilder = new DefinitionBuilder();
        }

        return $this->definitionBuilder;
    }
}

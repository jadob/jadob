<?php

namespace Jadob\Container;

use Jadob\Container\Exception\ContainerException;
use Jadob\Container\Exception\ServiceNotFoundException;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Psr\Container\ContainerInterface;

/**
 * PSR-11 Dependency Injection container.
 * @package Jadob\Container
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class Container implements ContainerInterface
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
     * {@inheritdoc}
     */
    public function get($id)
    {
        if (isset($this->factories[$id])) {

            $closure = $this->factories[$id];
            $service = $this->createServiceFromClosure($closure);

            unset($this->factories[$id]);
            $this->services[$id] = $service;
        }

        if (isset($this->services[$id])) {
            return $this->services[$id];
        }

        throw new ServiceNotFoundException('Service "' . $id . '" is not registered in container.');
    }

    /**
     * {@inheritdoc}
     */
    public function has($id)
    {
        return isset($this->factories[$id]) || isset($this->services[$id]);
    }

    /**
     * @param string $id
     * @param $object
     * @return Container
     * @throws ContainerException
     */
    public function add($id, $object)
    {
        if (!\is_scalar($id)) {
            throw new ContainerException('You cannot use non-scalar values as a service ID.');
        }

        if ($object instanceof \Closure) {
            $this->factories[$id] = $object;

            return $this;
        }

        $this->services[$id] = $object;
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
            $config = [];

            if ($configNode !== null && !isset($configuration[$configNode])) {
                throw new ContainerException('Config node "' . $configNode . '" requested by ' . $service . ' does not exists.');
            }

            if ($configNode !== null) {
                $config = $configuration[$configNode];
            }

            $provider->register($this, $config);
        }
    }

    /**
     * Search for class defined in $className and returns it. otherwise null returned.
     * @param $className
     * @return null|mixed
     * @throws \RuntimeException
     */
    public function findServiceByClassName($className)
    {
        foreach ($this->services as $key => $service) {
            if (\get_class($service) === $className) {
                return $service;
            }
        }

        throw new \RuntimeException('Class ' . $className . ' is not registered in container');
    }

    /**
     * @param \Closure $closure
     * @return mixed
     */
    public function createServiceFromClosure(\Closure $closure)
    {
        return $closure($this);
    }
}
<?php

namespace Jadob\Container;

use Psr\Container\ContainerInterface;
use Jadob\Container\Exception\ContainerException;
use Jadob\Container\Exception\ServiceNotFoundException;
use Zend\Config\Config;

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
     * @var array
     */
    private $container = [];

    /**
     * Container constructor.
     */
    public function __construct()
    {

    }

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
     * {@inheritdoc}
     */
    public function get($id)
    {
        if (isset($this->container[$id])) {
            return $this->container[$id];
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
            if(get_class($service) === $className) {
                return $service;
            }
        }

        throw new \RuntimeException('Class '.$className.' is not registered in container');
    }

    /**
     * @param array $providers
     * @param Config $configuration
     * @throws ContainerException
     */
    public function registerProviders(array $providers, Config $configuration)
    {
        foreach ($providers as $service) {
            /** @var \Jadob\Container\ServiceProvider\ServiceProviderInterface $provider * */
            $provider = new $service;

            $configNode = $provider->getConfigNode();
            $config = [];

            if($configNode !== null && !$configuration->offsetExists($configNode)) {
                throw new ContainerException('Config node "'.$configNode.'" requested by '.$service.' does not exists.');
            }

            if ($configNode !== null) {
                $config = $configuration[$configNode]->toArray();
            }

            $provider->register($this, $config);
        }
    }
}

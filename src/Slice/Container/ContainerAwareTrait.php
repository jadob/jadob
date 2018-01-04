<?php

namespace Slice\Container;


trait ContainerAwareTrait
{
    /**
     * @var Container
     */
    private $container;

    /**
     * @return Container
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @param $service
     * @return mixed
     * @throws \Slice\Container\Exception\ServiceNotFoundException
     */
    public function get($service)
    {
        return $this->getContainer()->get($service);
    }
}
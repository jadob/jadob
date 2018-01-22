<?php

namespace Slice\Container;

/**
 * Trait ContainerAwareTrait
 * @package Slice\Container
 * @author pizzaminded <miki@appvende.net>
 */
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
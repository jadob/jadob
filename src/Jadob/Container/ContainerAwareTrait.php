<?php

namespace Jadob\Container;

/**
 * Trait ContainerAwareTrait
 * @package Jadob\Container
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
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
     */
    public function get($service)
    {
        return $this->getContainer()->get($service);
    }
}
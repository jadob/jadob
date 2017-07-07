<?php
namespace Slice\Container;

/**
 * Allows to inject depedency container to class.
 * Class ContainerTrait
 * @package Slice\Container
 */
trait ContainerTrait
{

    /**
     * @var Container
     */
    private $container;

    /**
     * @return Container
     */
    public function getContainer(): Container
    {
        return $this->container;
    }

    /**
     * @param Container $container
     * @return $this
     */
    public function setContainer(Container $container)
    {
        $this->container = $container;
        return $this;
    }
}
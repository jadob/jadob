<?php
namespace Slice\Container;

/**
 * Interface ContainerAwareInterface
 * @package Slice\Container
 */
interface ContainerAwareInterface
{
    /**
     * @param Container $container
     * @return $this
     */
    public function setContainer(Container $container);

    /**
     * @return Container
     */
    public function getContainer(): Container;

}
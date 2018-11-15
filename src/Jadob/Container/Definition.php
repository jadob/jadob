<?php

namespace Jadob\Container;

/**
 * Class Definition
 * @package Jadob\Container
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class Definition
{
    /**
     * @var string
     */
    protected $serviceName;

    /**
     * FQCN, or some scalar value.
     * @var string
     */
    protected $object;

    /**
     * @var array
     */
    protected $arguments;

    /**
     * Definition constructor.
     * @param $serviceName
     * @param $object
     * @param array $args
     */
    public function __construct($serviceName, $object, array $args = [])
    {
        $this->serviceName = $serviceName;
        $this->object = $object;
        $this->arguments = $args;
    }

    /**
     * @return string
     */
    public function getServiceName()
    {
        return $this->serviceName;
    }

    /**
     * @param string $serviceName
     * @return Definition
     */
    public function setServiceName($serviceName): Definition
    {
        $this->serviceName = $serviceName;
        return $this;
    }

    /**
     * @return object|string
     */
    public function getObject()
    {
        return $this->object;
    }

    /**
     * @param object|string $object
     * @return Definition
     */
    public function setObject($object)
    {
        $this->object = $object;
        return $this;
    }

    /**
     * @return array
     */
    public function getArguments(): array
    {
        return $this->arguments;
    }

    /**
     * @param array $arguments
     * @return Definition
     */
    public function setArguments(array $arguments): Definition
    {
        $this->arguments = $arguments;
        return $this;
    }

}
<?php

namespace Jadob\Container;

use Jadob\Container\Exception\ContainerBuildException;

/**
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class Definition
{
    /**
     * @var bool
     */
    protected $created = false;

    /**
     * @var mixed
     */
    protected $service;

    /**
     * @var mixed
     */
    protected $instantiatedService;

    /**
     * @var array[]
     */
    protected $methodCalls = [];

    /**
     * Definition constructor.
     * @param mixed $service
     * @param bool $created
     */
    public function __construct($service, bool $created = false)
    {
        $this->service = $service;
        $this->created = $created;
    }

    public function addMethodCall(string $methodName, array $arguments = [])
    {
        $this->methodCalls[] = [
            'method' => $methodName,
            'arguments' => $arguments
        ];

        return $this;
    }

    /**
     * Returns instantiated service and prevents recreating it. 
     * @param Container $container
     * @return mixed
     * @throws ContainerBuildException
     */
    public function create(Container $container)
    {
        if ($this->isCreated()) {
            return $this->instantiatedService;
        }

        if (!\is_object($this->service)) {
            $this->created = true;
            $this->instantiatedService = $this->service;
            return $this->instantiatedService;
        }

        return $this->instantiatedService = $this->instantiate($container);
    }

    /**
     * Creates an instance of service basing on passed configuration 
     * @param Container $container
     * @return mixed
     * @throws ContainerBuildException
     */
    private function instantiate(Container $container)
    {
        $service = $this->service;

        if ($service instanceof \Closure) {
            $service = $service($container);
        }

        if ($service === null) {
            throw new ContainerBuildException('Closure does not return any value.');
        }

        foreach ($this->methodCalls as $methodCall) {
            \call_user_func_array([$service, $methodCall['method']], $methodCall['arguments']);
        }

        $this->created = true;

        return $service;
    }

    /**
     * @return bool
     */
    public function isCreated(): bool
    {
        return $this->created;
    }

}
<?php
declare(strict_types=1);

namespace Jadob\Container;

use Closure;
use Jadob\Container\Exception\ContainerBuildException;

/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
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
     * @var string[]
     */
    protected $tags = [];

    public function __construct(object $service)
    {
        $this->service = $service;
    }

    public function addMethodCall(string $methodName, array $arguments = []): self
    {
        $this->methodCalls[] = [
            'method' => $methodName,
            'arguments' => $arguments
        ];

        return $this;
    }

    /**
     * Returns instantiated service and prevents recreating it. 
     *
     * @param  Container $container
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
     * @deprecated
     * @param  Container $container
     * @return mixed
     * @throws ContainerBuildException
     */
    private function instantiate(Container $container)
    {
        $service = $this->service;

        if ($service instanceof Closure) {
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


    public function addTag(string $tag): void
    {
        $this->tags[] = $tag;
    }

    /**
     * @return string[]
     */
    public function getTags(): array
    {
        return $this->tags;
    }

}
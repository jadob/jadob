<?php

declare(strict_types=1);

namespace Jadob\Container;

/**
 * Set somewhere, instantiate when needed.
 * Works only with callable classes as this object exposes only __invoke() method from child class.
 * After class creating, child class will be available in Container.
 *
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class LazyInvokableClass
{

    protected $container;
    protected $class;

    public function __construct(Container $container, string $class)
    {
        $this->container = $container;
        $this->class = $class;
    }

    public function __invoke($args)
    {
        //@TODO if present in container, run them
        //@TODO if not present, autowire
        $childClass = $this->container->get($this->class);
        return $childClass(...$args);
    }
}
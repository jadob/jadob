<?php

namespace Jadob\Container\Definition;

use Jadob\Container\Definition;
use Jadob\Container\Exception\ContainerException;

/**
 * Class DefinitionBuilder
 * @package Jadob\Container\Definition
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class DefinitionBuilder
{

    public function __construct()
    {

    }

    /**
     * @param Definition $definition
     * @return array
     * @throws ContainerException
     * @throws \ReflectionException
     */
    public function buildDependencyFromDefinition(Definition $definition)
    {
        if (!\class_exists($definition->getObject())) {
            throw new ContainerException('Could not find class ' . $definition->getObject());
        }

        $className = $definition->getObject();
        $arguments = $definition->getArguments();

        return new $className(...$arguments);
    }

}
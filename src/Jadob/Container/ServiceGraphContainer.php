<?php

declare(strict_types=1);

namespace Jadob\Container;

use Jadob\Contracts\DependencyInjection\Reference;
use Jadob\Contracts\DependencyInjection\ReferenceType;
use Psr\Container\ContainerInterface;
use function array_map;
use function call_user_func_array;
use function is_string;

class ServiceGraphContainer implements ContainerInterface
{

    /**
     * @var array<string, object>
     */
    private array $initialized = [];

    public function __construct(
        private ServiceGraph $graph
    )
    {
    }

    public function get(string $id): object
    {
        if(isset($this->initialized[$id])) {
            return $this->initialized[$id];
        }

        $definition = $this->graph->get($id);

        $args = $this->resolveArgs($definition->arguments);


        if($definition->factory === null) {
            $reflectionClass = new \ReflectionClass($definition->className);

            return $this
                ->doInitialize(
                    $id,
                    $reflectionClass->newInstanceArgs($args),
                );
        }

        return $this
            ->doInitialize(
                $id,
                call_user_func_array($definition->factory, $args)
            );
    }

    private function doInitialize(
        string $id,
        object $service,
    ): object
    {
        $this->initialized[$id] = $service;
        return $service;
    }

    /**
     * @param array<string, Reference|string> $args
     * @return array
     */
    private function resolveArgs(array $args): array
    {
        return array_map(
            function (string|Reference $arg): string|object {
                if(is_string($arg)) {
                    return $arg;
                }

                if($arg->type === ReferenceType::Service) {
                    return $this->get(
                        $arg->value
                    );
                }

                throw new \LogicException('not implemented');
            },
            $args
        );
    }

    public function has(string $id): bool
    {
        return $this->graph->has($id);
    }
}
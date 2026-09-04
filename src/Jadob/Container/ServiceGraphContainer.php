<?php

declare(strict_types=1);

namespace Jadob\Container;

use Jadob\Contracts\DependencyInjection\Reference;
use Jadob\Contracts\DependencyInjection\ReferenceType;
use LogicException;
use Psr\Container\ContainerInterface;
use ReflectionClass;
use function array_map;
use function call_user_func_array;
use function is_string;

final class ServiceGraphContainer implements ContainerInterface
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
        if ($id === ContainerInterface::class) {
            return $this;
        }

        if (isset($this->initialized[$id])) {
            return $this->initialized[$id];
        }

        return $this->doInitialize($id);
    }

    private function doInitialize(
        string $id,
    ): object
    {
        $definition = $this->graph->get($id);
        $args = $this->resolveArgs(
            $definition->arguments
        );

        if ($definition->factory === null) {
            $reflectionClass = new ReflectionClass($definition->className);

            $service = $reflectionClass->newInstanceArgs($args);
        } else {
            $service = call_user_func_array(
                $definition->factory,
                $args
            );
        }

        foreach ($definition->methodCalls as $methodName => $methodArgsList) {
            foreach ($methodArgsList as $methodArgs) {
                call_user_func_array(
                    [$service, $methodName],
                    $this->resolveArgs($methodArgs)
                );
            }
        }

        return $this
            ->onServiceInitialized(
                $id,
                $service,
            );
    }

    private function onServiceInitialized(
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
            function (string|Reference $arg): string|object|array {
                if (is_string($arg)) {
                    return $arg;
                }

                if ($arg->type === ReferenceType::Service) {
                    return $this->get(
                        $arg->value
                    );
                }

                if ($arg->type === ReferenceType::TaggedServices) {
                    $tag = $arg->value;

                    return array_map(
                        fn(string $id): object => $this->get($id),
                        $this->graph->findTagged($tag)
                    );
                }

                if ($arg->type === ReferenceType::Literal) {
                    return $arg->value;
                }

                throw new LogicException('not implemented');
            },
            $args
        );
    }

    public function has(string $id): bool
    {
        return $this->graph->has($id);
    }
}
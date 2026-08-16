<?php

namespace Jadob\Container\Compiler\Extension;

use Jadob\Container\Compiler\ArgumentInjectHintsHandler;
use Jadob\Container\ServiceGraph;
use Jadob\Contracts\DependencyInjection\Attribute\InjectParameter;
use Jadob\Contracts\DependencyInjection\Attribute\InjectService;
use Jadob\Contracts\DependencyInjection\Attribute\InjectTaggedServices;
use Jadob\Contracts\DependencyInjection\CompilerExtensionInterface;
use Jadob\Contracts\DependencyInjection\Reference;
use LogicException;
use ReflectionFunction;
use ReflectionNamedType;
use function count;

final readonly class ResolveFactoryArguments implements CompilerExtensionInterface
{
    /**
     * @throws \ReflectionException
     */
    public function onContainerBuild(
        ServiceGraph $serviceGraph,
    ): void
    {
        foreach ($serviceGraph->all() as $definition) {
            if ($definition->factory === null) {
                continue;
            }

            $reflection = new ReflectionFunction($definition->factory);
            foreach ($reflection->getParameters() as $parameter) {
                $injectHintsReference = ArgumentInjectHintsHandler::process(
                    $parameter,
                );

                if($injectHintsReference instanceof Reference) {
                    $definition->withArgument(
                        $parameter->name,
                        $injectHintsReference
                    );
                    continue;
                }

                /** @var ReflectionNamedType $paramType */
                $paramType = $parameter->getType();

                $definition->withArgument(
                    $parameter->name,
                    Reference::service($paramType)
                );
            }
        }
    }
}
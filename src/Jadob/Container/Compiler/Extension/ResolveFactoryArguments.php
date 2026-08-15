<?php

namespace Jadob\Container\Compiler\Extension;

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
                $injectServiceAttrs = $parameter->getAttributes(InjectService::class);
                if (count($injectServiceAttrs) > 0) {
                    throw new LogicException('Not implemented');
                }

                $injectParameterAttrs = $parameter->getAttributes(InjectParameter::class);
                if (count($injectParameterAttrs) > 0) {
                    /** @var InjectParameter $attr */
                    $attr = $injectParameterAttrs[0]->newInstance();

                    $definition->withArgument(
                        $parameter->name,
                        Reference::param($attr->parameter)
                    );

                    continue;
                }

                $injectTaggedAttrs = $parameter->getAttributes(InjectTaggedServices::class);
                if (count($injectTaggedAttrs) > 0) {
                    /** @var InjectTaggedServices $attr */
                    $attr = $injectTaggedAttrs[0]->newInstance();

                    $definition->withArgument(
                        $parameter->name,
                        Reference::taggedServices($attr->tag)
                    );
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
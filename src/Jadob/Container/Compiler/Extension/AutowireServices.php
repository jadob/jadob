<?php
declare(strict_types=1);

namespace Jadob\Container\Compiler\Extension;

use Jadob\Container\Compiler\ArgumentInjectHintsHandler;
use Jadob\Container\Compiler\Exception\ContainerCompilerException;
use Jadob\Container\Compiler\Exception\InvalidServiceDefinitionException;
use Jadob\Container\ServiceGraph;
use Jadob\Contracts\DependencyInjection\CompilerExtensionInterface;
use Jadob\Contracts\DependencyInjection\Reference;
use ReflectionClass;

/**
 * Finds missing arguments to services which declares to be autowired.
 * @license MIT
 */
final readonly class AutowireServices implements CompilerExtensionInterface
{
    /**
     * @throws InvalidServiceDefinitionException
     * @throws ContainerCompilerException
     */
    public function onContainerBuild(ServiceGraph $serviceGraph): void
    {
        foreach ($serviceGraph->all() as $service) {
            if ($service->autowired === false) {
                continue;
            }

            if ($service->factory !== null) {
                throw new InvalidServiceDefinitionException(
                    sprintf(
                        'Service "%s" cannot use autowire() because it uses factory which is autowired automatically.',
                        $service->id
                    )
                );
            }

            $classConstructor = new ReflectionClass($service->className)->getConstructor();
            if($classConstructor === null) {
                continue;
            }

            $constructorArgs = $classConstructor->getParameters();

            foreach ($constructorArgs as $constructorArg) {
                $argumentName = $constructorArg->name;

                if ($service->hasArgument($argumentName)) {
                    continue;
                }

                $nullable = $constructorArg->allowsNull();

                $argumentType = $constructorArg
                    ->getType()
                    ->getName();

                $injectHintRef = ArgumentInjectHintsHandler::process($constructorArg);

                if ($injectHintRef instanceof Reference) {
                    $service->withArgument(
                        $argumentName,
                        $injectHintRef
                    );

                    continue;
                }

                $serviceExists = $serviceGraph->has($argumentType);

                if ($serviceExists) {
                    $service->withArgument(
                        $argumentName,
                        Reference::service($argumentType)
                    );
                }

                if (
                    $serviceExists === false
                    && $nullable === false
                ) {
                    throw new ContainerCompilerException(
                        sprintf(
                            'Argument "%s" for service "%s" cannot be autowired due to missing dependency. '
                            . 'Make argument nullable, register an missing service or configure service manually '
                            . 'In order to properly instantiate the service.',
                            $argumentName,
                            $service->id
                        )
                    );
                }

                if (
                    $serviceExists === false
                    && $nullable === true
                ) {
                    $service->withArgument(
                        $argumentType,
                        null
                    );
                }
            }
        }
    }
}
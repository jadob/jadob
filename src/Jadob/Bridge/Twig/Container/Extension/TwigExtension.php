<?php
declare(strict_types=1);

namespace Jadob\Bridge\Twig\Container\Extension;

use Jadob\Container\ServiceGraph;
use Jadob\Contracts\DependencyInjection\CompilerExtensionInterface;
use Jadob\Contracts\DependencyInjection\Reference;
use ReflectionFunction;
use Twig\Environment;
use Twig\RuntimeLoader\FactoryRuntimeLoader;

final class TwigExtension implements CompilerExtensionInterface
{
    public function onContainerBuild(ServiceGraph $serviceGraph): void
    {
        if ($serviceGraph->has(Environment::class) === false) {
            return;
        }

        $twigDefinition = $serviceGraph->get(Environment::class);
        $extensions = $serviceGraph->findTagged('twig.extension');

        foreach ($extensions as $extension) {
            $twigDefinition->addMethodCall(
                'addExtension',
                [
                    Reference::service($extension)
                ]
            );
        }
    }
}
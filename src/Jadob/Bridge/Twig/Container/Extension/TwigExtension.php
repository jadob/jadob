<?php
declare(strict_types=1);

namespace Jadob\Bridge\Twig\Container\Extension;

use Jadob\Container\ServiceGraph;
use Jadob\Contracts\DependencyInjection\CompilerExtensionInterface;
use Jadob\Contracts\DependencyInjection\ContainerExtensionInterface;
use Jadob\Contracts\DependencyInjection\ContainerInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use ReflectionException;
use ReflectionFunction;
use Twig\Environment;
use Twig\RuntimeLoader\FactoryRuntimeLoader;

class TwigExtension implements CompilerExtensionInterface
{

    public function onContainerBuild(ServiceGraph $serviceGraph): void
    {
        dd(__METHOD__);
        $twig = $container->get(Environment::class);
        $extensions = $container->getTaggedServices('twig.extension');

        foreach ($extensions as $extension) {
            $twig->addExtension($extension);
        }

        $runtimeLoaders = $container->getTaggedServices('twig.runtime_loader');
        if (count($runtimeLoaders) === 0) {
            return;
        }

        $runtimeLoadersMapping = [];
        foreach ($runtimeLoaders as $runtimeLoader) {
            /**
             * TODO: replace it when container tags will support k/v entries
             */
            $loaderClass = (new ReflectionFunction($runtimeLoader))->getReturnType()->getName();
            $runtimeLoadersMapping[$loaderClass] = $runtimeLoader;
        }

        $twig->addRuntimeLoader(new FactoryRuntimeLoader(
            $runtimeLoadersMapping,
        ));
    }
}
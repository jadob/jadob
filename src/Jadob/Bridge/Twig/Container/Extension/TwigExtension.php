<?php

namespace Jadob\Bridge\Twig\Container\Extension;

use Jadob\Container\Container;
use Jadob\Contracts\DependencyInjection\ContainerExtensionInterface;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use ReflectionFunction;
use Twig\Environment;
use Twig\RuntimeLoader\FactoryRuntimeLoader;

class TwigExtension implements ContainerExtensionInterface
{

    /**
     * @throws ContainerExceptionInterface
     * @throws \ReflectionException
     * @throws NotFoundExceptionInterface
     */
    public function onContainerBuild(Container $container): void
    {

        $twig = $container->get(Environment::class);
        $extensions = $container->getTaggedServices('twig.extension');

        foreach ($extensions as $extension) {
            $twig->addExtension($extension);
        }

        $runtimeLoaders = $container->getTaggedServices('twig.runtime_loader');
        if(count($runtimeLoaders) === 0) {
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
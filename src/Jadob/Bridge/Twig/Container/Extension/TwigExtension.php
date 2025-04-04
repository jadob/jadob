<?php

namespace Jadob\Bridge\Twig\Container\Extension;

use Jadob\Container\Container;
use Jadob\Contracts\DependencyInjection\ContainerExtensionInterface;
use Symfony\Component\Form\FormRenderer;
use Twig\Environment;
use Twig\RuntimeLoader\FactoryRuntimeLoader;

class TwigExtension implements ContainerExtensionInterface
{

    public function onContainerBuild(Container $container): void
    {

        $twig = $container->get(Environment::class);
        $extensions = $container->getTaggedServices('twig.extension');

        foreach ($extensions as $extension) {
            $twig->addExtension($extension);
        }

    }
}
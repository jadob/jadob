<?php
declare(strict_types=1);

namespace Jadob\Bridge\Twig\Container\ExtensionProvider;

use Jadob\Bridge\Twig\Container\Extension\TwigExtension;
use Jadob\Contracts\DependencyInjection\ContainerExtensionProviderInterface;
use Psr\Container\ContainerInterface;

class TwigExtensionProvider implements ContainerExtensionProviderInterface
{
    public function getAutowiringExtensions(ContainerInterface $container): array
    {
        return [];
    }

    public function getContainerExtensions(): array
    {
        return [
            new TwigExtension()
        ];
    }
}
<?php
declare(strict_types=1);

namespace Jadob\Bridge\Twig\Module;

use Jadob\Bridge\Twig\Container\ExtensionProvider\TwigExtensionProvider;
use Jadob\Bridge\Twig\ServiceProvider\TwigProvider;
use Jadob\Contracts\Framework\Module\ModuleInterface;
use Psr\Container\ContainerInterface;

class TwigModule implements ModuleInterface
{
    public function getServiceProviders(string $env): array
    {
        return [
            new TwigProvider()
        ];
    }

    public function getContainerExtensionProviders(string $env): array
    {
        return [
            new TwigExtensionProvider()
        ];
    }

    public function getEventListeners(ContainerInterface $container, string $env): array
    {
        return [];
    }
}
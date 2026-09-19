<?php
declare(strict_types=1);

namespace Jadob\Bridge\Twig\Module;

use Jadob\Bridge\Twig\Container\Extension\TwigExtension;
use Jadob\Bridge\Twig\ServiceProvider\TwigProvider;
use Jadob\Contracts\Framework\Module\ModuleInterface;

final readonly class TwigModule implements ModuleInterface
{
    public function getServiceProviders(string $env): array
    {
        return [
            new TwigProvider()
        ];
    }

    public function getContainerCompilerExtensions(): array
    {
        return [
            600 => new TwigExtension()
        ];
    }
}
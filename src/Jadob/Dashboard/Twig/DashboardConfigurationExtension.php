<?php
declare(strict_types=1);

namespace Jadob\Dashboard\Twig;

use Jadob\Dashboard\Configuration\DashboardConfiguration;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class DashboardConfigurationExtension extends AbstractExtension
{
    protected DashboardConfiguration $configuration;

    public function __construct(
        DashboardConfiguration $configuration
    ) {
        $this->configuration = $configuration;
    }


    public function getFunctions(): array
    {
        return [
            new TwigFunction('dashboard_get_config', [$this, 'getDashboardConfig'])
        ];
    }

    public function getDashboardConfig(): DashboardConfiguration
    {
        return $this->configuration;
    }
}
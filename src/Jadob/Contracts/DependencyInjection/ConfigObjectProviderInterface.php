<?php
declare(strict_types=1);

namespace Jadob\Contracts\DependencyInjection;

interface ConfigObjectProviderInterface
{
    public function getDefaultConfigurationObject(): object;
}
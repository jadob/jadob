<?php
declare(strict_types=1);

namespace Jadob\Contracts\DependencyInjection;

use Jadob\Container\Config\ConfigNodeInterface;

interface ConfigObjectProviderInterface
{
    /**
     * If your services require some configuration, you can create a config node, return its name here, and it will
     * be passed further into register() method.
     */
    public function getConfigNode(): string;

    public function getDefaultConfigurationObject(): ConfigNodeInterface;
}
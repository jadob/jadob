<?php

namespace Jadob\Contracts\DependencyInjection;

interface ConfigObjectProviderInterface
{
    public function getDefaultConfigurationObject(): object;
}
<?php

declare(strict_types=1);

namespace Jadob\Contracts\DependencyInjection;

/**
 * @license MIT
 */
interface ServiceProviderHandlerInterface
{
    /**
     * @param object $serviceProvider
     * @return void
     */
    public function registerServiceProvider(object $serviceProvider): void;
}
<?php

declare(strict_types=1);

namespace Jadob\Contracts\DependencyInjection;

/**
 * @TODO: Find out why this interface exists - what was the purpose of this one? Otherwise this class should be removed, as it does not seem helpful.
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
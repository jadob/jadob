<?php

declare(strict_types=1);

namespace Jadob\Contracts\DependencyInjection;

interface ParentServiceProviderInterface
{

    /**
     * Returns a list of FQCNs of providers, that need to be registered BEFORE the current provider will be registered.
     * @return list<class-string>
     */
    public function getParentServiceProviders(): array;
}
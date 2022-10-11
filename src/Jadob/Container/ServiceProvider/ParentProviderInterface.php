<?php
declare(strict_types=1);

namespace Jadob\Container\ServiceProvider;

/**
 * Allows to define additional Service Providers that you Provider would not work properly.
 * Parent providers are registered BEFORE the current one. Also they are skipped in further execution, so there is
 * no chance to instantiate provider more than once.
 *
 *
 * @see docs/components/container/parent-providers.md
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
interface ParentProviderInterface
{

    /**
     * @return string[] Parent Class names
     */
    public function getParentProviders(): array;
}
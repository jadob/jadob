<?php

namespace Jadob\Container\ServiceProvider;

/**
 * Experimental Feature
 * Provides default configuration which can be overriden by user and later used to execute current provider.
 *
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
interface DefaultConfigProviderInterface
{

    /**
     * Warning: returned array should be compliant with XSD schema used with current provider.
     *
     * @return array
     */
    public function getDefaultConfig(): array;
}
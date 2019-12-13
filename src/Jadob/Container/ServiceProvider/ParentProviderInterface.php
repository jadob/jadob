<?php

namespace Jadob\Container\ServiceProvider;

/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
interface ParentProviderInterface
{

    /**
     * @return ServiceProviderInterface[]
     */
    public function getParentProviders(): array;

}
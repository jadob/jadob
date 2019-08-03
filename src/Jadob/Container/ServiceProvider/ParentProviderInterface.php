<?php

namespace Jadob\Container\ServiceProvider;

/**
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
interface ParentProviderInterface
{

    /**
     * @return ServiceProviderInterface[]
     */
    public function getParentProviders(): array;

}
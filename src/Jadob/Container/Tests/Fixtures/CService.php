<?php

namespace Jadob\Container\Tests\Fixtures;

/**
 * @internal
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 */
class CService
{

    protected $service;

    public function __construct(AService $service)
    {
        $this->service = $service;
    }

    /**
     * @return AService
     */
    public function getService(): AService
    {
        return $this->service;
    }
}
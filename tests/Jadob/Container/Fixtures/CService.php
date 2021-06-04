<?php

namespace Jadob\Container\Fixtures;

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
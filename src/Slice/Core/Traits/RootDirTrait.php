<?php

namespace Slice\Core\Traits;


/**
 * Trait RootDirTrait
 * @package Slice\Core\Traits
 * @deprecated
 */
trait RootDirTrait
{

    protected $rootDir;

    /**
     * @return mixed
     */
    public function getRootDir(): string
    {
        return $this->rootDir;
    }

    /**
     * @param mixed $rootDir
     * @return $this
     */
    public function setRootDir($rootDir)
    {
        $this->rootDir = $rootDir;
        return $this;
    }
}
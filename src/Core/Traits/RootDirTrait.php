<?php
/**
 * Created by PhpStorm.
 * User: mikolajczajkowsky
 * Date: 13.06.2017
 * Time: 23:08
 */

namespace Slice\Core\Traits;


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
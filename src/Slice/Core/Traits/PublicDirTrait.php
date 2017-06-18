<?php
namespace Slice\Core\Traits;


trait PublicDirTrait
{

    protected $publicDir;

    /**
     * @return mixed
     */
    public function getPublicDir(): string
    {
        return $this->publicDir;
    }

    /**
     * @param mixed $publicDir
     * @return $this
     */
    public function setPublicDir($publicDir)
    {
        $this->publicDir = $publicDir;
        return $this;
    }
}
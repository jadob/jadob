<?php
namespace Slice\Core;

use ErrorException;
use Slice\Core\Traits\PublicDirTrait;
use Slice\Core\Traits\RootDirTrait;
use Throwable;

/**
 * Class Framework
 * @package Slice\Core
 * @deprecated
 */
class Framework
{
    use PublicDirTrait;
    use RootDirTrait;

    private $environment;
    private $kernel;


    public function __construct(/*$env*/)
    {
//        $this->environment = new Environment($env);

//        if (!$this->isProductionEnvironment()) {
//            $this->registerExceptionHandler();
//            $this->registerErrorHandler();
//        }

//        $this->kernel = new Kernel($this->environment);

    }

    /**
     * @return mixed
     */
    public function getEnvironment(): string
    {
        return $this->environment;
    }


    public function getKernel(): Kernel
    {
        return $this->kernel
            ->setPublicDir($this->getPublicDir())
            ->setRootDir($this->getRootDir());
    }

    public function isProductionEnvironment(): bool
    {
        return $this->environment->isProduction();
    }

}
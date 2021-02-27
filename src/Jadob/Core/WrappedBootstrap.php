<?php
declare(strict_types=1);

namespace Jadob\Core;


/**
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class WrappedBootstrap implements BootstrapInterface
{

    protected BootstrapInterface $parent;
    protected ?string $cacheDir;

    public function __construct(BootstrapInterface $parent, ?string $cacheDir = null)
    {
        $this->parent = $parent;
        $this->cacheDir = $cacheDir;
    }


    public function getPublicDir(): string
    {
        return $this->parent->getPublicDir();
    }

    public function getConfigDir(): string
    {
        return $this->parent->getConfigDir();
    }

    public function getCacheDir(): string
    {
        return $this->cacheDir ?? $this->parent->getCacheDir();
    }

    public function getRootDir(): string
    {
        return $this->parent->getRootDir();
    }

    public function getLogsDir(): string
    {
        return $this->parent->getLogsDir();
    }

    public function getServiceProviders(string $env): array
    {
        return $this->parent->getServiceProviders($env);
    }
}
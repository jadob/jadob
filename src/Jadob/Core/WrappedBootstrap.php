<?php
declare(strict_types=1);

namespace Jadob\Core;

/**
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class WrappedBootstrap implements BootstrapInterface
{
    public function __construct(protected BootstrapInterface $parent, protected ?string $cacheDir = null)
    {
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

    public function getDefaultLogStream(string $env): string
    {
        return $this->parent->getDefaultLogStream($env);
    }
}
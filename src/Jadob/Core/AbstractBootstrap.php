<?php
declare(strict_types=1);

namespace Jadob\Core;

/**
 * There are some required methods implemented.
 * You can extend your bootstrap class by this one to get some job done.
 * By default, Jadob uses php-pds standards (@see https://github.com/php-pds/skeleton)
 * but you can override this to your own needs.
 *
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
abstract class AbstractBootstrap implements BootstrapInterface
{
    /**
     * {@inheritdoc}
     */
    public function getPublicDir(): string
    {
        return $this->getRootDir() . '/public';
    }

    /**
     * {@inheritdoc}
     */
    public function getConfigDir(): string
    {
        return $this->getRootDir() . '/config';
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheDir(): string
    {
        return $this->getRootDir() . '/var';
    }

    /**
     * {@inheritdoc}
     */
    public function getLogsDir(): string
    {
        return $this->getCacheDir() . '/logs';
    }

    public function getDefaultLogStream(string $env): string
    {
        return sprintf('%s/%s.log', $this->getLogsDir(), $env);
    }
}
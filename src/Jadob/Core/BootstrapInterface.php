<?php
declare(strict_types=1);

namespace Jadob\Core;

use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Jadob\Framework\Module\ModuleInterface;

/**
 * Interface for framework bootstrapping class.
 * This one must be implemented by your Bootstrap class.
 *
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 */
interface BootstrapInterface
{
    /**
     * Returns path to web server root directory.
     *
     * @return string
     */
    public function getPublicDir(): string;

    /**
     * Returns path to config files directory
     *
     * @return string
     */
    public function getConfigDir(): string;

    /**
     * Returns cache files directory.
     *
     * @return string
     */
    public function getCacheDir(): string;

    /**
     * Returns project root directory.
     *
     * @return string
     */
    public function getRootDir(): string;

    /**
     * Returns log files directory.
     *
     * @return string
     */
    public function getLogsDir(): string;

    /**
     * Returns array of Service providers that will be load while framework bootstrapping.
     *
     * @param string $env
     * @return list<ServiceProviderInterface>
     */
    public function getServiceProviders(string $env): array;

    /**
     * Where to send logs by default?
     * @param string $env
     * @return string
     */
    public function getDefaultLogStream(string $env): string;

    /**
     * @return array<ModuleInterface>
     */
    public function getModules(): array;
}
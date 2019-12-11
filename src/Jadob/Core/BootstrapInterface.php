<?php

namespace Jadob\Core;

/**
 * Interface for framework bootstrapping class.
 * This one must be implemented by your Bootstrap class.
 *
 * @package Jadob\Core
 * @author  pizzaminded <miki@appvende.net>
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
     * @return array
     */
    public function getServiceProviders(): array;

}
<?php

declare(strict_types=1);

namespace Jadob\Bridge\Symfony\Console\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\Core\Kernel;
use Symfony\Component\Console\Application;

/**
 * Adds symfony/console functionality to framework.
 *
 * @see     https://symfony.com/doc/3.4/components/console.html
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class ConsoleProvider implements ServiceProviderInterface
{

    /**
     * {@inheritdoc}
     */
    public function getConfigNode()
    {
        return null;
    }

    /**
     * @param null $config
     *
     * @return Application[]|null
     *
     * @psalm-return array{console: Application}|null
     */
    public function register($config): ?array
    {
        /**
         * We should not rely on PHP_SAPI here
         */
        if (strtolower(PHP_SAPI) === 'cli') {
            return ['console' => new Application('Jadob', Kernel::VERSION)];
        }

        return null;
    }

    /**
     * {@inheritdoc}
     */
    public function onContainerBuild(Container $container, $config)
    {
    }
}
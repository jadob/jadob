<?php
declare(strict_types=1);

namespace Jadob\Container\ServiceProvider;

use Jadob\Container\Container;
use Psr\Container\ContainerInterface;

/**
 * Class AbstractServiceProvider
 *
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
abstract class AbstractServiceProvider implements ServiceProviderInterface
{
    /**
     * {@inheritdoc}
     *
     * @return void
     */
    public function register(ContainerInterface $container, ?array $config): array
    {
    }

    /**
     * {@inheritdoc}
     */
    public function onContainerBuild(Container $container, $config)
    {
    }
}
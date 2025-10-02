<?php
declare(strict_types=1);

namespace Jadob\Router\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Contracts\DependencyInjection\ConfigObjectProviderInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Jadob\Core\RequestContextStore;
use Jadob\Router\RouteCollection;
use Jadob\Router\Router;
use Jadob\Router\RouterContext;
use Jadob\Router\StickyParameterStore;
use Psr\Container\ContainerInterface;
use function is_array;

/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class RouterServiceProvider implements ServiceProviderInterface, ConfigObjectProviderInterface
{
    public function getConfigNode(): ?string
    {
        return 'router';
    }

    /**
     * @TODO: when aliases will be available, use router FQCN as service name and point the 'router' alias to them
     * @param ContainerInterface $container
     * @phpstan-param RouterConfiguration $config
     * @return mixed
     */
    public function register(ContainerInterface $container, array|null|object $config = null): array
    {
        return [
            'router' => function () use ($config): Router {
                return new Router(
                    RouteCollection::fromArray($config->getRoutes()),
                    new RouterContext(
                        port: $config->getPort(),
                        secure: $config->secure || false,
                        host: $config->getHost(),
                        basePath: $config->getBasePath(),
                    ),
                    $config->isCaseSensitive()
                );
            }
        ];
    }


    public function getDefaultConfigurationObject(): object
    {
        return new RouterConfiguration();
    }
}

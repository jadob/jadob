<?php
declare(strict_types=1);

namespace Jadob\Router\ServiceProvider;

use Jadob\Container\Config\ConfigNodeInterface;
use Jadob\Contracts\DependencyInjection\Attribute\InjectTaggedServices;
use Jadob\Contracts\DependencyInjection\ConfigObjectProviderInterface;
use Jadob\Contracts\DependencyInjection\ContainerBuilderInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Jadob\Router\RouteCollection;
use Jadob\Router\Router;
use Jadob\Router\RouterContext;
use LogicException;

/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class RouterServiceProvider implements ServiceProviderInterface, ConfigObjectProviderInterface
{
    public function getConfigNode(): string
    {
        return 'router';
    }

    public function register(ContainerBuilderInterface $builder, ?ConfigNodeInterface $config = null): void
    {
        if (!($config instanceof RouterConfiguration)) {
            throw new LogicException(
                sprintf(
                    'Invalid configuration object passed to "%s"',
                    self::class
                )
            );
        }


        $builder->set(Router::class)
            ->withFactory(
                static function (
                    #[InjectTaggedServices('router.collection')]
                    array $routeCollections
                ) use ($config) {
                    $globalRouteCollection = new RouteCollection();
                    foreach ($routeCollections as $routeCollection) {
                        $globalRouteCollection->merge($routeCollection);
                    }

                    $globalRouteCollection->merge(
                        RouteCollection::fromArray($config->getRoutes()),
                    );

                    return new Router(
                        routeCollection: $globalRouteCollection,
                        context: new RouterContext(
                            host: $config->getHost(),
                            secure: $config->secure,
                            port: $config->getPort(),
                            basePath: $config->getBasePath(),
                        ),
                        caseSensitive: $config->isCaseSensitive()
                    );
                }
            );

        $builder->alias(Router::class, 'router');
    }


    public function getDefaultConfigurationObject(): ConfigNodeInterface
    {
        return new RouterConfiguration();
    }
}

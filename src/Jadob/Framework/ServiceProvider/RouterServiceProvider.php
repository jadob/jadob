<?php
declare(strict_types=1);

namespace Jadob\Framework\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Jadob\Core\RequestContextStore;
use Jadob\Router\Context;
use Jadob\Router\RouteCollection;
use Jadob\Router\Router;
use Jadob\Router\StickyParameterStore;
use Psr\Container\ContainerInterface;
use function is_array;

/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class RouterServiceProvider implements ServiceProviderInterface
{
    public function getConfigNode(): ?string
    {
        return 'router';
    }

    public function register(ContainerInterface $container, array|null|object $config = null): array
    {
        return [
            'router' => static function (ContainerInterface $container) use ($config): Router {
                $collection = $config['routes'];
                if (is_array($config['routes'])) {
                    $collection = RouteCollection::fromArray($config['routes']);
                }

                $context = Context::fromGlobals();
                if (isset($config['context']) && empty($config['context']['base_url'])) {
                    $context->setHost($config['context']['host']);
                    $context->setPort($config['context']['port']);
                }

                if (isset($config['context']['base_url'])) {
                    $context = Context::fromBaseUrl($config['context']['base_url']);
                }

                if (isset($config['force_https']) && (bool) $config['force_https'] === true) {
                    $context->setSecure(true);
                }

                return new Router(
                    $collection,
                    $context,
                    $config,
                    [],
                    new StickyParameterStore(
                        $container->get(RequestContextStore::class)
                    )
                );
            }];
    }

    /**
     * {@inheritdoc}
     */
    public function onContainerBuild(Container $container, $config)
    {
        // TODO: Implement onContainerBuild() method.
    }
}

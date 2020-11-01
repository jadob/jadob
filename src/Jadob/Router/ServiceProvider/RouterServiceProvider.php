<?php
declare(strict_types=1);

namespace Jadob\Router\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\Router\Context;
use Jadob\Router\RouteCollection;
use Jadob\Router\Router;

/**
 * @package Jadob\Router\ServiceProvider
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class RouterServiceProvider implements ServiceProviderInterface
{

    /**
     * @return string
     */
    public function getConfigNode()
    {
        return 'router';
    }

    /**
     * @param  $config
     * @return \Closure[]
     * @throws \Jadob\Router\Exception\RouterException
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Psr\Container\ContainerExceptionInterface
     */
    public function register($config)
    {
        return [
            'router' => static function () use ($config): Router {
                $collection = $config['routes'];
                if (\is_array($config['routes'])) {
                    $collection = RouteCollection::fromArray($config['routes']);
                }

                $context = Context::fromGlobals();
                if (isset($config['context']) && empty($config['context']['base_url'])) {
                    $context->setHost($config['context']['host']);
                    $context->setPort($config['context']['port']);
                }

                if(isset($config['context']['base_url'])) {
                    $context = Context::fromBaseUrl($config['context']['base_url']);
                }

                if(isset($config['force_https']) && (bool)$config['force_https'] === true) {
                    $context->setSecure(true);
                }

                return new Router($collection, $context);
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

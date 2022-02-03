<?php
declare(strict_types=1);

namespace Jadob\PagerfantaBridge\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\PagerfantaBridge\Twig\Extension\PagerfantaExtension;

/**
 * Class PagerfantaProvider
 *
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class PagerfantaProvider implements ServiceProviderInterface
{
    public function getConfigNode()
    {
        return null;
    }

    /**
     * @param array|null $config
     *
     * @return array
     */
    public function register($config)
    {
        return [
            'pagerfanta.extension', function (Container $container) {
                return new PagerfantaExtension(
                    $container->get('request'),
                    $container->get('router')
                );
            }
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function onContainerBuild(Container $container, $config)
    {
        $container->get('twig')->addExtension($container->get('pagerfanta.extension'));
    }
}
<?php

namespace Jadob\Bridge\Twig\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\Core\BootstrapInterface;
use Psr\Container\ContainerInterface;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use Twig\Loader\LoaderInterface;

/**
 * Class TwigServiceProvider
 * @package Jadob\Bridge\Twig\ServiceProvider
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class TwigServiceProvider implements ServiceProviderInterface
{

    /**
     * {@inheritdoc}
     */
    public function getConfigNode()
    {
        return 'twig';
    }

    /**
     * {@inheritdoc}
     * @throws \Twig\Error\LoaderError
     */
    public function register($config)
    {
        $loaderClosure = function (ContainerInterface $container) use ($config) {
            $loader = new FilesystemLoader();
            $loader->addPath(__DIR__ . '/../templates', 'Jadob');

            foreach ($config['templates_paths'] as $key => $path) {
                $loader->addPath($container->get(BootstrapInterface::class)->getRootDir() . '/' . $path, $key);
            }

            return $loader;
        };

        $environmentClosure = function (ContainerInterface $container) use ($config) {
            $cache = false;
            if ($config['cache']) {
                $cache = $container->get(BootstrapInterface::class)->getCacheDir() . '/twig';
            }

            $options = [
                'cache' => $cache,
                'strict_variables' => $config['strict_variables']
            ];

            $environment = new Environment(
                $container->get(LoaderInterface::class),
                $options
            );

            if (isset($config['globals']) && \is_array($config['globals'])) {
                foreach ($config['globals'] as $globalKey => $globalValue) {
                    $environment->addGlobal($globalKey, $globalValue);
                }
            }

            return $environment;
        };

        return [
            LoaderInterface::class => $loaderClosure,
            Environment::class => $environmentClosure
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function onContainerBuild(Container $container, $config)
    {
        // TODO: Implement onContainerBuild() method.
    }
}
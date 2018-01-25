<?php

namespace Slice\TwigBridge\ServiceProvider;

use Slice\Container\Container;
use Slice\Container\ServiceProvider\ServiceProviderInterface;
use Slice\TwigBridge\Twig\Extension\AssetExtension;
use Slice\TwigBridge\Twig\Extension\DebugExtension;
use Slice\TwigBridge\Twig\Extension\PathExtension;

/**
 * Class TwigServiceProvider
 * @package Slice\TwigBridge\ServiceProvider
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class TwigServiceProvider implements ServiceProviderInterface
{

    /**
     * @return string
     */
    public function getConfigNode()
    {
        return 'twig';
    }

    /**
     * @param Container $container
     * @param $config
     * @return mixed|void
     * @throws \Slice\Container\Exception\ContainerException
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @throws \Twig_Error_Loader
     */
    public function register(Container $container, $config)
    {
        /** @var \Bootstrap $bootstrap */
        $bootstrap = $container->get('bootstrap');

        $loader = new \Twig_Loader_Filesystem();
        foreach ($config['templates_paths'] as $key => $path) {
            $loader->addPath($bootstrap->getRootDir() . $path, $key);
        }

        $cache = false;
        if ($config['cache']) {
            $cache = $bootstrap->getCacheDir() . '/twig';
        }

        $twig = new \Twig_Environment($loader, [
            'cache' => $cache,
            'strict_variables' => $config['strict_variables']
        ]);

        $appVariables = [
            'router' => $container->get('router'),
            'request' => $container->get('request'),
            'user' => $container->get('auth.user.storage')->getUser(),
            'flashes' => $container->get('session')->getFlashBag()
        ];

        $twig->addGlobal('app', $appVariables);

        $twig->addExtension(new AssetExtension($container->get('request')));
        $twig->addExtension(new PathExtension($container->get('router')));
        $twig->addExtension(new DebugExtension());

        $container->add('twig', $twig);
    }

}
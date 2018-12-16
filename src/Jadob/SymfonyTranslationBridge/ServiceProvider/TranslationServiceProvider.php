<?php

namespace Jadob\SymfonyTranslationBridge\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\ContainerBuilder;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\SymfonyTranslationBridge\Twig\Extension\TranslationExtension;
use Symfony\Component\Translation\Loader\ArrayLoader;
use Symfony\Component\Translation\Translator;

/**
 * @TODO: translation should be lazy
 * Class TranslationServiceProvider
 * @package Jadob\SymfonyTranslationBridge\ServiceProvider
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class TranslationServiceProvider implements ServiceProviderInterface
{

    /**
     * @return mixed
     */
    public function getConfigNode()
    {
        return 'translator';
    }

    /**
     * @param ContainerBuilder $container
     * @param $config [] Config node
     * @throws \Symfony\Component\Translation\Exception\InvalidArgumentException
     */
    public function register(ContainerBuilder $container, $config)
    {

        $translator = new Translator($config['locale']);
        $translator->addLoader('array', new ArrayLoader());

        foreach ($config['sources'] as $locale => $paths) {
            foreach ($paths as $path) {
                $translator->addResource('array', include $path, $locale);
            }
        }

        $container->add('translator', $translator);

    }

    /**
     * {@inheritdoc}
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
     */
    public function onContainerBuild(Container $container, $config)
    {
        $container->get('twig')->addExtension(new TranslationExtension($container->get('translator')));
    }
}
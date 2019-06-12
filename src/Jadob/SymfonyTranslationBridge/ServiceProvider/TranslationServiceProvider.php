<?php

namespace Jadob\SymfonyTranslationBridge\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\ContainerBuilder;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\SymfonyTranslationBridge\Twig\Extension\TranslationExtension;
use Psr\Container\ContainerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Translation\Loader\ArrayLoader;
use Symfony\Component\Translation\LoggingTranslator;
use Symfony\Component\Translation\Translator;

/**
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
     * @param $config [] Config node
     * @return array
     */
    public function register($config)
    {

        return ['translator' => static function (ContainerInterface $container) use ($config) {

            $translator = new Translator($config['locale']);
            $translator->addLoader('array', new ArrayLoader());

            foreach ($config['sources'] as $locale => $paths) {
                foreach ($paths as $path) {
                    $translator->addResource('array', include $path, $locale);
                }
            }
            return new LoggingTranslator($translator, $container->get(LoggerInterface::class));
        }];
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
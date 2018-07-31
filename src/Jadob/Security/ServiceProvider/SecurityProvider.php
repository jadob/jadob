<?php

namespace Jadob\Security\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\Security\Auth\AuthenticationManager;
use Jadob\Security\Auth\Event\AuthListener;
use Jadob\Security\Auth\Event\LogoutListener;
use Jadob\Security\Auth\Provider\DatabaseUserProvider;
use Jadob\Security\Auth\UserStorage;
use Symfony\Component\Serializer\Encoder\ChainEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class SecurityProvider
 * @package Jadob\Security\ServiceProvider
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class SecurityProvider implements ServiceProviderInterface
{

    /**
     * @return mixed
     */
    public function getConfigNode()
    {
        return 'security';
    }

    /**
     * @param Container $container
     * @param $config
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
     */
    public function register(Container $container, $config)
    {

        $serializerEncoders = [
            new ChainEncoder(),
            new XmlEncoder(),
            new JsonEncoder()
        ];

        $serializerNormalizers = [
            new DateTimeNormalizer(),
            new ObjectNormalizer()
        ];

        $serializer = new Serializer($serializerNormalizers, $serializerEncoders);

        $container->add('serializer', $serializer);

        $container->add(
            'auth.user.storage',
            new UserStorage($container->get('session'))
        );

        if (!isset($config['auth'])) {
            return;
        }

        // registering auth stuff
        $authConfig = $config['auth'];


        $authenticationManager =  new AuthenticationManager(
            $container->get('auth.user.storage'),
            $container->get('logger')
        );


        if ($authConfig['user_provider'] === 'database') {
            $provider = new DatabaseUserProvider(
                $container->get('database'),
                $authConfig['provider_settings']
            );

            $authenticationManager->setProvider($provider);
        }

        $container->add('auth.authentication.manager', $authenticationManager);

        $container->get('event.listener')->addListener(
            new AuthListener(
                $container->get('request'),
                $container->get('auth.authentication.manager'),
                $authConfig,
                $container->get('router')
            ),
            1
        );

        $container->get('event.listener')->addListener(
            new LogoutListener(
                $container->get('request'),
                $container->get('auth.authentication.manager'),
                $authConfig,
                $container->get('router')
            ),
            1
        );
    }
}
<?php

namespace Jadob\Security\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\Security\Auth\AuthenticationManager;
use Jadob\Security\Auth\Event\AuthListener;
use Jadob\Security\Auth\Event\LogoutListener;
use Jadob\Security\Auth\Provider\DatabaseUserProvider;
use Jadob\Security\Auth\UserStorage;

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
     * @return mixed
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
     */
    public function register(Container $container, $config)
    {
        if (!isset($config['auth'])) {
            return;
        }

        // registering auth stuff
        $authConfig = $config['auth'];

        if ($authConfig['user_provider'] === 'database') {
            $provider = new DatabaseUserProvider(
                $container->get('database'),
                $authConfig['provider_settings']
            );
        }

        $container->add(
            'auth.user.storage',
            new UserStorage($container->get('session'))
        );

        $container->add(
            'auth.authentication.manager',
            new AuthenticationManager(
                $container->get('auth.user.storage'),
                $provider
            )
        );

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
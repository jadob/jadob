<?php

namespace Slice\Security\ServiceProvider;

use Slice\Container\Container;
use Slice\Container\ServiceProvider\ServiceProviderInterface;
use Slice\EventListener\EventListener;
use Slice\Security\Auth\AuthenticationManager;
use Slice\Security\Auth\Event\AuthListener;
use Slice\Security\Auth\Event\LogoutListener;
use Slice\Security\Auth\Provider\DatabaseUserProvider;
use Slice\Security\Auth\UserStorage;

/**
 * Class SecurityProvider
 * @package Slice\Security\ServiceProvider
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
     * @throws \Slice\Container\Exception\ServiceNotFoundException
     */
    public function register(Container $container, $config)
    {
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

        $container->get('event.listener')->register(
            EventListener::EVENT_AFTER_ROUTER,
            new AuthListener(
                $container->get('request'),
                $container->get('auth.authentication.manager'),
                $authConfig,
                $container->get('router')
            )
        );

        $container->get('event.listener')->register(
            EventListener::EVENT_AFTER_ROUTER,
            new LogoutListener(
                $container->get('request'),
                $container->get('auth.authentication.manager'),
                $authConfig,
                $container->get('router')
            )
        );
    }
}
<?php

namespace Jadob\Security\Firewall\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\Security\Firewall\EventListener\AuthCheckListener;
use Jadob\Security\Firewall\EventListener\FirewallListener;
use Jadob\Security\Firewall\Firewall;
use RuntimeException;

/**
 * Class FirewallProvider
 * @package Jadob\Security\Firewall\ServiceProvider
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class FirewallProvider implements ServiceProviderInterface
{

    /**
     * {@inheritdoc}
     */
    public function getConfigNode()
    {
        return 'framework';
    }

    /**
     * {@inheritdoc}
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
     * @throws \RuntimeException
     */
    public function register(Container $container, $config)
    {
        if (!$container->has('user.storage')) {
            throw new RuntimeException('AuthProvided should be passed before FirewallProvided to enable firewall.');
        }

        //moving to guard, so this one would not be needed

//        $firewall = new Firewall($config['security']);
//
//        $container->add('firewall', $firewall);
//        $container->get('event.listener')->addListener(
//            new FirewallListener($firewall, $container->get('user.storage')), 1
//        );
//        $container->get('event.listener')->addListener(
//            new AuthCheckListener($firewall, $container->get('user.storage')), 2
//        );
    }
}
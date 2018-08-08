<?php

namespace Jadob\Security\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\Security\Firewall\EventListener\FirewallListener;
use Jadob\Security\Firewall\Firewall;

/**
 * Class FirewallProvider
 * @package Jadob\Security\ServiceProvider
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
        return 'security';
    }

    /**
     * @param Container $container
     * @param array|null $config
     * @throws \Jadob\Container\Exception\ServiceNotFoundException
     */
    public function register(Container $container, $config)
    {

        $firewall = new Firewall(
            $container->get('auth.authentication.manager'),
            $config['firewall']
        );

        $firewallRule = $firewall->getMatchingRouteByRequest($container->get('request'));

        $container->get('auth.authentication.manager')->setFirewallRule($firewallRule);
        $container->add('firewall', $firewall);
        $container->add('firewall.matching.rule', $firewallRule);

    }
}
<?php 

namespace Slice\Core\ServiceProvider;

use Slice\Container\Container;
use Slice\Container\ServiceProvider\ServiceProviderInterface;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class TopLevelServicesProvider
 * @package Slice\Core\ServiceProvider
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class TopLevelServicesProvider implements ServiceProviderInterface {

    /**
     * @return mixed|null
     */
    public function getConfigNode() {
		return null;
	}

    /**
     * @param Container $container
     * @param $config
     * @return mixed|void
     */
    public function register(Container $container, $config) {
            $container->add('session', new Session());
	}
	
}
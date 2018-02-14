<?php 

namespace Jadob\Core\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Symfony\Component\HttpFoundation\Session\Session;

/**
 * Class TopLevelServicesProvider
 * @package Jadob\Core\ServiceProvider
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
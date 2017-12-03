<?php 

namespace Slice\Core\ServiceProvider;

use Slice\Container\Container;

use Slice\Container\ServiceProvider\ServiceProviderInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class TopLevelServicesProvider implements ServiceProviderInterface {
	
	public function getConfigNode() {
		return null;
	}
	
	public function register(Container $container, $config) {
            $container->add('session', new Session());
	}
	
}
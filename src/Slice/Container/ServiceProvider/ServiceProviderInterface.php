<?php

namespace Slice\Container\ServiceProvider;

use Slice\Container\Container;

interface ServiceProviderInterface {

	
	public function getConfigNode();

	public function register(Container $container, $config);
}
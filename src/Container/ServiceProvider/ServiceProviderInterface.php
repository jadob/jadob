<?php
namespace Slice\Container\ServiceProvider;

use Slice\Container\Container;

interface ServiceProviderInterface {

    public function register(Container $container);
}
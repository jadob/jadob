<?php

namespace Jadob\Container\Tests\Fixtures\ServiceProvider;

use Jadob\Container\Container;
use Jadob\Container\ServiceProvider\ServiceProviderInterface;
use Jadob\Container\Tests\Fixtures\ExampleService;
use Jadob\Container\Tests\Fixtures\YetAnotherExampleService;

class AServiceProvider implements ServiceProviderInterface
{


    public function getConfigNode()
    {
        return null;
    }


    /**
     * @return (ExampleService|\Closure)[]
     *
     * @psalm-return array{a.1: ExampleService, a.2: \Closure():YetAnotherExampleService}
     */
    public function register($config)
    {
        return [
            'a.1' => new ExampleService(),
            'a.2' => static function () {
                return new YetAnotherExampleService();
            }
        ];
    }


    public function onContainerBuild(Container $container, $config)
    {
        // TODO: Implement onContainerBuild() method.
    }
}
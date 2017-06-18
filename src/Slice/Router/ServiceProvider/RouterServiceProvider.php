<?php
/**
 * Created by PhpStorm.
 * User: mikolajczajkowsky
 * Date: 18.06.2017
 * Time: 00:42
 */

namespace Slice\Router\ServiceProvider;


use Slice\Container\Container;
use Slice\Container\ServiceProvider\ServiceProviderInterface;
use Slice\Router\Router;

class RouterServiceProvider implements ServiceProviderInterface
{

    protected $params;

    public function __construct(array $params)
    {
        $this->params = $params;
    }


    public function register(Container $container)
    {
        $router = new Router();

    }
}
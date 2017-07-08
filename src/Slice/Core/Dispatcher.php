<?php

namespace Slice\Core;

use Slice\Container\ContainerTrait;
use Slice\Core\HTTP\ResponseInterface;

/**
 * Class Dispatcher
 * @package Slice\Core
 */
class Dispatcher
{

    use ContainerTrait;

    /**
     * @var ResponseInterface
     */
    protected $response;

    /**
     * @return $this
     * @throws \Slice\Container\Exception\ContainerException
     */
    public function dispatch()
    {
        $router = $this->getContainer()->get('router');
        $router->matchRoute();

        return $this;
    }

    public function sendOutput()
    {
        echo $this->response->getContent();
    }

}
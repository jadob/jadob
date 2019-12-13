<?php

namespace Jadob\Core\Controller;

use Jadob\Container\Container;

/**
 * @package Jadob\Core\Controller
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class ControllerClassResolver
{
    /**
     * @var Container
     */
    protected $container;

    protected $controller;

    /**
     * ControllerClassResolver constructor.
     *
     * @param Container $container
     * @param $controller
     */
    public function __construct(Container $container, $controller)
    {
        $this->container = $container;
        $this->controller = $controller;
    }
}
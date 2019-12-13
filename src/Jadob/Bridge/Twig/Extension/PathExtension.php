<?php

namespace Jadob\Bridge\Twig\Extension;

use Jadob\Router\Router;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Class PathExtension
 *
 * @package Jadob\TwigBridge\Twig\Extension
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class PathExtension extends AbstractExtension
{

    /**
     * @var Router
     */
    private $router;

    /**
     * PathExtension constructor.
     *
     * @param Router $router
     */
    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('path', [$this, 'path'], ['is_safe' => ['html'],]),
            new TwigFunction('url', [$this, 'url'], ['is_safe' => ['html'],]),
        ];
    }

    /**
     * @param  $path
     * @param  $params
     * @return string
     * @throws \Jadob\Router\Exception\RouteNotFoundException
     */
    public function path($path, $params = [])
    {
        return $this->router->generateRoute($path, $params);
    }

    /**
     * @param  $path
     * @param  $params
     * @return string
     * @throws \Jadob\Router\Exception\RouteNotFoundException
     */
    public function url($path, $params = [])
    {
        return $this->router->generateRoute($path, $params, true);
    }
}
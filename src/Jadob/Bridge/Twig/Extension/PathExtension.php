<?php

namespace Jadob\Bridge\Twig\Extension;

use Jadob\Router\Router;

/**
 * Class PathExtension
 * @package Jadob\TwigBridge\Twig\Extension
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class PathExtension extends \Twig_Extension
{

    /**
     * @var Router
     */
    private $router;

    /**
     * PathExtension constructor.
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
            new \Twig_SimpleFunction('path', [$this, 'path'], ['is_safe' => ['html'],]),
            new \Twig_SimpleFunction('url', [$this, 'url'], ['is_safe' => ['html'],]),
        ];
    }

    /**
     * @param $path
     * @param $params
     * @return string
     * @throws \Jadob\Router\Exception\RouteNotFoundException
     */
    public function path($path, $params = [])
    {
        return $this->router->generateRoute($path, $params);
    }

    /**
     * @param $path
     * @param $params
     * @return string
     * @throws \Jadob\Router\Exception\RouteNotFoundException
     */
    public function url($path, $params = [])
    {
        return $this->router->generateRoute($path, $params, true);
    }
}
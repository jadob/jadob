<?php


namespace Jadob\Bridge\Twig\Extension;

/**
 * Class DebugExtension
 * @package Jadob\Debug\Twig\Extension
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class DebugExtension extends \Twig_Extension
{
    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('r', [$this, 'debug'], ['is_safe' => ['html'],]),
        ];
    }

    public function debug()
    {
        return @r(\func_get_args());
    }
}
<?php

namespace Jadob\TwigBridge\Twig\Extension;


use Symfony\Component\HttpFoundation\Request;

/**
 * @deprecated
 * Class AssetExtension
 * @package Jadob\TwigBridge\Twig\Extension
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class AssetExtension extends \Twig_Extension
{

    /**
     * @var Request
     */
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction('asset', [$this, 'asset'], ['is_safe' => ['html'],]),
        ];
    }

    public function asset($path, $fullURI = false)
    {
        $path = \sprintf('/%s', ltrim($path, '/'));

        if($fullURI) {
            return $this->request->getSchemeAndHttpHost().'/'.$path;
        }

        return $path;
    }
}
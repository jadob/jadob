<?php
declare(strict_types=1);

namespace Jadob\Bridge\Twig\Extension;

use Jadob\Router\Exception\RouteNotFoundException;
use Jadob\Router\Router;
use function ltrim;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 *
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class PathExtension extends AbstractExtension
{

    /**
     * @var Router
     */
    private Router $router;

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
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('path', [$this, 'path'], ['is_safe' => ['html']]),
            new TwigFunction('url', [$this, 'url'], ['is_safe' => ['html']]),
            new TwigFunction('asset_url', [$this, 'assetUrl'], ['is_safe' => ['html']])
        ];
    }

    /**
     * @param string $path
     * @param array $params
     * @return string
     * @throws RouteNotFoundException
     */
    public function path(string $path, array $params = []): string
    {
        return $this->router->generateRoute($path, $params);
    }

    /**
     * @param string $path
     * @param array $params
     * @return string
     * @throws RouteNotFoundException
     */
    public function url(string $path, array $params = []): string
    {
        return $this->router->generateRoute($path, $params, true);
    }

    /**
     * Generates an absolute URL to given asset in project public root.
     * @param string $path
     * @return string
     */
    public function assetUrl(string $path): string
    {
        $context = $this->router->getContext();

        $protocol = 'http';

        if ($context->isSecure()) {
            $protocol = 'https';
        }

        $port = null;

        if (
            !($context->isSecure() && $context->getPort() === 443)
            && !(!$context->isSecure() && $context->getPort() === 80)
        ) {
            $port = $context->getPort();
        }

        return $protocol . '://' . $context->getHost() . ($port !== null ? ':' . $port : null) . '/' . ltrim($path, '/');
    }
}
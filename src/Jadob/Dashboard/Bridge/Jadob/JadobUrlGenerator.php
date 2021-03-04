<?php
declare(strict_types=1);

namespace Jadob\Dashboard\Bridge\Jadob;


use Jadob\Dashboard\UrlGeneratorInterface;
use Jadob\Router\Router;

class JadobUrlGenerator implements UrlGeneratorInterface
{

    protected Router $router;


    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function generateRoute(string $name, array $params = []): string
    {
        return $this->router->generateRoute($name, $params);
    }
}
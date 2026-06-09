<?php
declare(strict_types=1);

namespace Jadob\Container\Fixtures\ServiceProviders;

use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Psr\Container\ContainerInterface;

class HttpClientProvider implements ServiceProviderInterface
{
    public function getConfigNode(): ?string
    {
        return 'http_client';
    }

    public function register(ContainerInterface $container, object|array|null $config = null): array
    {
        return [];
    }
}
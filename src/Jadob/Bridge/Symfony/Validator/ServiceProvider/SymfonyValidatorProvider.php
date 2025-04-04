<?php

namespace Jadob\Bridge\Symfony\Validator\ServiceProvider;

use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Psr\Container\ContainerInterface;

class SymfonyValidatorProvider implements ServiceProviderInterface
{

    public function getConfigNode(): ?string
    {
        return null;
    }

    public function register(ContainerInterface $container, object|array|null $config = null): array
    {

    }
}
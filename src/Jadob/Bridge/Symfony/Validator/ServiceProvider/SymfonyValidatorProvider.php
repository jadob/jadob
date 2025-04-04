<?php
declare(strict_types=1);

namespace Jadob\Bridge\Symfony\Validator\ServiceProvider;

use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class SymfonyValidatorProvider implements ServiceProviderInterface
{
    public function getConfigNode(): ?string
    {
        return null;
    }

    public function register(ContainerInterface $container, object|array|null $config = null): array
    {
        return [
            ValidatorInterface::class => static function() {
                return Validation::createValidatorBuilder()->getValidator();
            }
        ];
    }
}
<?php

declare(strict_types=1);

namespace Jadob\Bridge\Symfony\Validator\ServiceProvider;

use Jadob\Container\Config\ConfigNodeInterface;
use Jadob\Contracts\DependencyInjection\ContainerBuilderInterface;
use Jadob\Contracts\DependencyInjection\ServiceProviderInterface;
use Psr\Container\ContainerInterface;
use Symfony\Component\Validator\Validation;
use Symfony\Component\Validator\Validator\RecursiveValidator;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final readonly class SymfonyValidatorProvider implements ServiceProviderInterface
{
    public function register(
        ContainerBuilderInterface $builder,
        ?ConfigNodeInterface $config = null
    ): void
    {
        $builder
            ->set(RecursiveValidator::class)
            ->factory(function () {
                return Validation::createValidatorBuilder()->getValidator();
            });

        $builder
            ->bind(ValidatorInterface::class, RecursiveValidator::class);
    }
}
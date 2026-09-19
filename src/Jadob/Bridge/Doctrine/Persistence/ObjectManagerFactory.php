<?php

declare(strict_types=1);

namespace Jadob\Bridge\Doctrine\Persistence;

use Closure;
use Doctrine\Persistence\ObjectManager;

final readonly class ObjectManagerFactory implements ObjectManagerFactoryInterface
{
    public function __construct(
        private Closure $factory,
    ) {
    }

    public function build(): ObjectManager
    {
        return ($this->factory)();
    }
}
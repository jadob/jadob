<?php declare(strict_types=1);

namespace Jadob\Bridge\Doctrine\Persistence;

use Doctrine\Persistence\ObjectManager;

interface ObjectManagerFactoryInterface
{
    public function build(): ObjectManager;
}
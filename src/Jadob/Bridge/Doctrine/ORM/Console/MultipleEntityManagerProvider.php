<?php

declare(strict_types=1);

namespace Jadob\Bridge\Doctrine\ORM\Console;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\Console\EntityManagerProvider;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @internal
 */
final readonly class MultipleEntityManagerProvider implements EntityManagerProvider
{
    public function __construct(
        protected ManagerRegistry $managerRegistry,
    )
    {
    }

    public function getManager(string $name): EntityManagerInterface
    {
        return $this->managerRegistry->getManager($name);
    }

    public function getDefaultManager(): EntityManagerInterface
    {
        $managerName = $this->managerRegistry->getDefaultManagerName();
        return $this->managerRegistry->getManager($managerName);
    }
}
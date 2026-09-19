<?php

declare(strict_types=1);

namespace Jadob\Bridge\Doctrine\Persistence;

use Doctrine\Persistence\ConnectionRegistry;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;
use LogicException;

final class DoctrineManagerRegistry implements ManagerRegistry
{
    /**
     * @var array<string, ObjectManager>
     */
    private array $instantiatedManagers = [];

    /**
     * @param array<string, ObjectManagerFactoryInterface> $entityManagerFactories
     */
    public function __construct(
        private readonly array $entityManagerFactories,
        private readonly string $defaultManagerName,
        private readonly ConnectionRegistry $connectionRegistry,
    ) {
        foreach ($entityManagerFactories as $entityManagerFactory) {
            if (!($entityManagerFactory instanceof ObjectManagerFactoryInterface)) {
                throw new LogicException(
                    sprintf(
                        'Entity manager factory must be a %s, %s given',
                        ObjectManagerFactoryInterface::class,
                        gettype($entityManagerFactory)
                    )
                );
            }
        }
    }

    public function getDefaultConnectionName(): string
    {
        return $this
            ->connectionRegistry
            ->getDefaultConnectionName();
    }

    public function getConnection($name = null): object
    {
        return $this
            ->connectionRegistry
            ->getConnection($name);
    }

    public function getConnections(): array
    {
        return $this
            ->connectionRegistry
            ->getConnections();
    }

    public function getConnectionNames(): array
    {
        return $this
            ->connectionRegistry
            ->getConnectionNames();
    }

    public function getDefaultManagerName(): string
    {
        // TODO: Implement getDefaultManagerName() method.
    }

    public function getManager(?string $name = null): ObjectManager
    {
        if (array_key_exists($name, $this->instantiatedManagers) === false) {
            $manager = $this->entityManagerFactories[$name]->build();
            $this->instantiatedManagers[$name] = $manager;
        }

        return $this->instantiatedManagers[$name];
    }

    public function getManagers(): array
    {
        // TODO: Implement getManagers() method.
    }

    public function resetManager(?string $name = null): ObjectManager
    {
        $name = $name ?? $this->getDefaultManagerName();
        unset($this->instantiatedManagers[$name]);

        return $this->getManager($name);
    }

    public function getManagerNames(): array
    {
        // TODO: Implement getManagerNames() method.
    }

    public function getRepository(string $persistentObject, ?string $persistentManagerName = null): ObjectRepository
    {
        // TODO: Implement getRepository() method.
    }

    public function getManagerForClass(string $class): ObjectManager|null
    {
        // TODO: Implement getManagerForClass() method.
    }
}
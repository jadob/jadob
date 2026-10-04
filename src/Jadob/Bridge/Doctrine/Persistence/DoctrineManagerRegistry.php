<?php

declare(strict_types=1);

namespace Jadob\Bridge\Doctrine\Persistence;

use Doctrine\Persistence\ConnectionRegistry;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;
use LogicException;
use Throwable;

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
        return $this->defaultManagerName;
    }

    public function getManager(?string $name = null): ObjectManager
    {
        if ($name === null) {
            $name = $this->defaultManagerName;
        }
        $this->ensureManagerInstantiated($name);

        return $this->instantiatedManagers[$name];
    }

    /**
     * @return array<string, ObjectManager>
     */
    public function getManagers(): array
    {
        $this->ensureAllManagersAreInstantiated();

        return $this->instantiatedManagers;
    }

    public function resetManager(?string $name = null): ObjectManager
    {
        $name = $name ?? $this->getDefaultManagerName();
        unset($this->instantiatedManagers[$name]);

        return $this->getManager($name);
    }

    public function getManagerNames(): array
    {
        return array_map(
            static fn (ObjectManagerFactoryInterface $factory) => $factory->getServiceId(),
            $this->entityManagerFactories
        );
    }

    public function getRepository(string $persistentObject, ?string $persistentManagerName = null): ObjectRepository
    {
        return $this
            ->getManager($persistentManagerName ?? $this->getDefaultManagerName())
            ->getRepository($persistentObject);
    }

    public function getManagerForClass(string $class): ObjectManager|null
    {
        foreach ($this->getManagers() as $manager) {
            try {
                $manager->getClassMetadata($class);

                return $manager;
            } catch (Throwable) {
            }
        }

        return null;
    }

    private function ensureAllManagersAreInstantiated(): void
    {
        foreach ($this->getManagerNames() as $name) {
            $this->ensureManagerInstantiated($name);
        }
    }

    private function ensureManagerInstantiated(string $name): void
    {
        if (array_key_exists($name, $this->instantiatedManagers) === false) {
            $this->instantiatedManagers[$name] = $this->instantiate($this->entityManagerFactories[$name]);
        }
    }

    private function instantiate(
        ObjectManagerFactoryInterface $factory,
    ): ObjectManager {
        return $factory->build();
    }
}
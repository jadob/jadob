<?php
declare(strict_types=1);

namespace Jadob\Bridge\Doctrine\Persistence;

use Doctrine\DBAL\Connection;
use Doctrine\ORM\Mapping\MappingException;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;
use Exception;

class DoctrineManagerRegistry implements ManagerRegistry
{
    /**
     * @var Connection[]
     */
    protected array $connections = [];
    protected string $defaultConnection = 'default';
    /**
     * @var ObjectManager[]
     */
    protected array $managers = [];
    protected string $defaultManager = 'default';

    public function getDefaultConnectionName(): string
    {
        return $this->defaultConnection;
    }

    public function getConnection($name = null): object
    {
        if ($name === null) {
            return $this->connections[$this->defaultConnection];
        }

        return $this->connections[$name];
    }

    public function getConnections(): array
    {
        return $this->connections;
    }

    public function getConnectionNames(): array
    {
        return array_keys($this->connections);
    }

    public function getDefaultManagerName(): string
    {
        return $this->defaultManager;
    }

    public function getManager($name = null): ObjectManager
    {
        if ($name === null) {
            return $this->managers[$this->defaultManager];
        }

        return $this->managers[$name];
    }

    public function getManagers(): array
    {
        return $this->managers;
    }

    public function resetManager($name = null): ObjectManager
    {
        throw new Exception('resetManager NIY');
    }

    public function getManagerNames(): array
    {
        return array_keys($this->managers);
    }

    public function getRepository($persistentObject, $persistentManagerName = null): ObjectRepository
    {
        if($persistentManagerName) {
            return $this->getManager($persistentManagerName)->getRepository($persistentObject);
        }
        return $this->getManagerForClass($persistentObject)->getRepository($persistentObject);
    }

    /**
     * @TODO: rewrite it in a more more maintainable fashion - catch does not catch anything
     * @param $class
     * @return ObjectManager|null
     */
    public function getManagerForClass($class): ?ObjectManager
    {
        foreach ($this->managers as $manager) {
            try {
                $manager->getClassMetadata($class);
                return $manager;
            } catch (MappingException $_) {
            }
        }

        return null;
    }

    public function addConnection(string $name, Connection $connection): void
    {
        $this->connections[$name] = $connection;
    }

    public function setDefaultConnectionName(string $defaultConnection): void
    {
        $this->defaultConnection = $defaultConnection;
    }

    public function addManager(string $name, ObjectManager $manager): void
    {
        $this->managers[$name] = $manager;
    }

    public function setDefaultManagerName(string $defaultManager): void
    {
        $this->defaultManager = $defaultManager;
    }
}
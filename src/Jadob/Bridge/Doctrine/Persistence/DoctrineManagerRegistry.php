<?php
declare(strict_types=1);

namespace Jadob\Bridge\Doctrine\Persistence;


use Doctrine\DBAL\Connection;
use Doctrine\ORM\Mapping\MappingException;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Persistence\ObjectRepository;

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

    public function getDefaultConnectionName()
    {
        return $this->defaultConnection;
    }

    public function getConnection($name = null)
    {
        if ($name == null) {
            return $this->connections[$this->defaultConnection];
        }

        return $this->connections[$name];
    }

    public function getConnections()
    {
        return $this->connections;
    }

    public function getConnectionNames()
    {
        return array_keys($this->connections);
    }

    public function getDefaultManagerName()
    {
        return $this->defaultManager;
    }

    public function getManager($name = null)
    {
        if($name === null) {
            return $this->managers[$this->defaultManager];
        }

        return $this->managers[$name];
    }

    public function getManagers()
    {
        return $this->managers;
    }

    public function resetManager($name = null)
    {
        throw new \Exception('resetManager NIY');
    }

    public function getAliasNamespace($alias)
    {
        throw new \Exception('resetManager NIY');
    }

    public function getManagerNames()
    {
        return array_keys($this->managers);
    }

    public function getRepository($persistentObject, $persistentManagerName = null)
    {
        throw new \Exception('resetManager NIY');
    }

    public function getManagerForClass($class)
    {
        foreach ($this->managers as $manager) {
            try {
                $manager->getClassMetadata($class);
                return $manager;
            } catch (MappingException $_) {

            }
        }

        return false;
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
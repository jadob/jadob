<?php

namespace Jadob\DoctrineORMBridge\Registry;

use Doctrine\Common\Persistence\ManagerRegistry as DoctrineManagerRegistry;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\Persistence\ObjectRepository;

/**
 * Allows you to manage your EntityManagers when using more than one in your project.
 * @package Jadob\DoctrineORMBridge\Registry
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class ManagerRegistry implements DoctrineManagerRegistry
{

    /**
     * @var ObjectManager[]
     */
    protected $connections;


    /**
     * @param ObjectManager $manager
     * @param string $name
     * @return $this
     */
    public function addObjectManager(ObjectManager $manager, $name)
    {
        $this->connections[$name] = $manager;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultConnectionName()
    {
        // TODO: Implement getDefaultConnectionName() method.
    }

    /**
     * {@inheritdoc}
     */
    public function getConnection($name = null)
    {
        // TODO: Implement getConnection() method.
    }

    /**
     * {@inheritdoc}
     */
    public function getConnections()
    {
        return $this->connections;
    }

    /**
     * {@inheritdoc}
     */
    public function getConnectionNames()
    {
        // TODO: Implement getConnectionNames() method.
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultManagerName()
    {
        return 'default';
    }

    /**
     * {@inheritdoc}
     */
    public function getManager($name = null)
    {
        // TODO: Implement getManager() method.
    }

    /**
     * {@inheritdoc}
     */
    public function getManagers()
    {
        // TODO: Implement getManagers() method.
    }

    /**
     * {@inheritdoc}
     */
    public function resetManager($name = null)
    {
        throw new \RuntimeException('This function is not implemented yet.');
    }

    /**
     * {@inheritdoc}
     */
    public function getAliasNamespace($alias)
    {
        // TODO: Implement getAliasNamespace() method.
    }

    /**
     * {@inheritdoc}
     */
    public function getManagerNames()
    {
        // TODO: Implement getManagerNames() method.
    }

    /**
     * {@inheritdoc}
     */
    public function getRepository($persistentObject, $persistentManagerName = null)
    {
        // TODO: Implement getRepository() method.
    }

    /**
     * {@inheritdoc}
     */
    public function getManagerForClass($class)
    {
        // TODO: Implement getManagerForClass() method.
    }
}
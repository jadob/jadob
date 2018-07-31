<?php

namespace Jadob\DoctrineORMBridge\UserProvider;

use Doctrine\ORM\EntityManager;
use Jadob\Security\Auth\Provider\UserProviderInterface;

/**
 * Class DoctrineORMUserProvider
 * @package Jadob\DoctrineORMBridge\UserProvider
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class DoctrineORMUserProvider implements UserProviderInterface
{

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var string
     */
    protected $entityClass;

    /**
     * DoctrineORMUserProvider constructor.
     * @param EntityManager $em
     * @param $entityClass
     */
    public function __construct(EntityManager $em, $entityClass)
    {
        $this->em = $em;
        $this->entityClass = $entityClass;
    }

    /**
     * @param $username
     * @return mixed
     */
    public function loadUserByUsername($username)
    {
        return $this->em->getRepository($this->entityClass)->loadUserByUsername($username);
    }
}
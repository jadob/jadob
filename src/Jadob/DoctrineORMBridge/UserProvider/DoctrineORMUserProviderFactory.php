<?php

namespace Jadob\DoctrineORMBridge\UserProvider;

use Doctrine\ORM\EntityManager;
use Jadob\Security\Auth\Provider\UserProviderFactoryInterface;
use Jadob\Security\Auth\Provider\UserProviderInterface;

/**
 * Class DoctrineORMUserProviderFactory
 * @package Jadob\DoctrineORMBridge\UserProvider
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 * @deprecated
 */
class DoctrineORMUserProviderFactory implements UserProviderFactoryInterface
{

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * DoctrineORMUserProviderFactory constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * @param array $providerSettings
     * @return UserProviderInterface
     */
    public function create(array $providerSettings): UserProviderInterface
    {
        return new DoctrineORMUserProvider($this->em, $providerSettings['repository']);
    }
}
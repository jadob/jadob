<?php

namespace Jadob\Security\Auth\Provider;

use Jadob\Database\Database;

/**
 * Class DatabaseUserProviderFactory
 * @package Jadob\Security\Auth\Provider
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class DatabaseUserProviderFactory implements UserProviderFactoryInterface
{

    /**
     * @var Database
     */
    protected $db;

    /**
     * DatabaseUserProviderFactory constructor.
     * @param Database $db
     */
    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    /**
     * @param array $providerSettings
     * @return UserProviderInterface
     */
    public function create(array $providerSettings): UserProviderInterface
    {
        return new DatabaseUserProvider(
            $this->db,
            $providerSettings
        );
    }
}
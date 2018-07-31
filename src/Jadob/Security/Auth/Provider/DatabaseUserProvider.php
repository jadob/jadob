<?php

namespace Jadob\Security\Auth\Provider;

use Jadob\Database\Database;

/**
 * Class DatabaseUserProvider
 * @package Jadob\Security\Auth\Provider
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class DatabaseUserProvider implements UserProviderInterface
{

    /**
     * @var Database
     */
    protected $db;

    /**
     * @var array[]
     */
    protected $config;

    /**
     * DatabaseUserProvider constructor.
     * @param Database $db
     * @param $config
     */
    public function __construct(Database $db, $config)
    {
        $this->db = $db;
        $this->config = $config;
    }


    /**
     * @param string $username
     * @return mixed
     * @throws \Exception
     */
    public function loadUserByUsername($username)
    {
        /**
         * @var UserProviderInterface $userProviderModel
         */
        /** @noinspection PhpParamsInspection */
        $userProviderModel = $this->db->getModel($this->config['model']);
        return $userProviderModel->loadUserByUsername($username);
    }
}
<?php

namespace Slice\Security\Auth\Provider;

use Slice\Database\Database;
use Slice\Security\Auth\User;

class DatabaseUserProvider implements UserProviderInterface
{

    /**
     * @var Database
     */
    protected $db;

    protected $config;

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
         * @var UserProviderInterface $userProviderModel;
         */
        $userProviderModel = $this->db->getModel($this->config['model']);
        return $userProviderModel->loadUserByUsername($username);
    }
}
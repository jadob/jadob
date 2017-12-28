<?php

namespace Slice\Security\Auth\Provider;


/**
 * Interface UserProviderInterface
 * @package Slice\Security\Auth\Provider
 */
interface UserProviderInterface
{
    /**
     * @param string $username
     * @return mixed
     */
    public function loadUserByUsername($username);

}
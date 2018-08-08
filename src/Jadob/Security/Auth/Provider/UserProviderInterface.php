<?php

namespace Jadob\Security\Auth\Provider;

/**
 * Interface UserProviderInterface
 * @package Jadob\Security\Auth\Provider
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
interface UserProviderInterface
{
    public function loadUserByUsername($username);

    public function loadUserById($id);
}
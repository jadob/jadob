<?php

namespace Jadob\Security\Auth;

/**
 * Interface UserProviderInterface
 * @package Jadob\Security\Auth
 * @author pizzaminded <miki@appvende.net>
 */
interface UserProviderInterface
{

    public function getUserByUsername($name);

    public function getOneById($id);
}
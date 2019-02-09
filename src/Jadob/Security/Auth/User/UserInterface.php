<?php

namespace Jadob\Security\Auth\User;

/**
 * Interface UserInterface
 * @package Jadob\Security\Auth
 * @author pizzaminded <miki@appvende.net>
 */
interface UserInterface
{

    /**
     * @return string[]
     */
    public function getRoles();

    /**
     * @return string
     */
    public function getPassword();

}
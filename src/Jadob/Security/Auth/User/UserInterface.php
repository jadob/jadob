<?php

namespace Jadob\Security\Auth\User;

/**
 * Interface UserInterface
 *
 * @package Jadob\Security\Auth
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
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

    /**
     * @return mixed
     */
    public function getUsername();

}
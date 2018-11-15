<?php

namespace Jadob\Security\Auth\User;

/**
 * Interface UserInterface
 * @package Jadob\Security\Auth\User
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
interface UserInterface
{
    public function getId();

    public function getUsername();

    public function getPassword();

    public function getRoles();
}
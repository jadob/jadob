<?php

namespace Jadob\Security\Auth;

/**
 * Interface UserInterface
 * @package Jadob\Security\Auth
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
interface UserInterface
{
    public function getUsername();

    public function getRoles();

    public function getPassword();
}
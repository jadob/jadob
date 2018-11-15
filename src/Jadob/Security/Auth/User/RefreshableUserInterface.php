<?php

namespace Jadob\Security\Auth\User;

/**
 * When your user needs to be refreshed on each request, your user class should implement this one.
 * @package Jadob\Security\Auth\User
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
interface RefreshableUserInterface
{
    /**
     * ID is the thing that wouldnt be changed, so we will use this value to fetch user data
     * @return mixed
     */
    public function getId();
}
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
    /**
     * @return string
     */
    public function getUsername();

    /**
     * @return string[]
     */
    public function getRoles();

    /**
     * @return string
     */
    public function getPassword();

    /**
     * @return bool
     */
    public function userNeedsRefreshing();

    /**
     * @return mixed
     */
    public function getId();
}
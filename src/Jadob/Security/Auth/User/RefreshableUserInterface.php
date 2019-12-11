<?php

namespace Jadob\Security\Auth\User;

/**
 * In some cases user object should be fetched once again on each request.
 * When your User class needs to be refreshed, just implement this one.
 *
 * @package Jadob\Security\Auth\User
 * @author  pizzaminded <miki@appvende.net>
 * @license MIT
 */
interface RefreshableUserInterface
{
    public function getId();
}

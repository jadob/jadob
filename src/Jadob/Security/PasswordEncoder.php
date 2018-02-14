<?php

namespace Jadob\Security;

/**
 * Password encoding class.
 * @package Jadob\Security
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class PasswordEncoder
{
    /**
     * Hashes password using bcrypt algorithm.
     * @param $password
     * @param int $cost
     * @return bool|string
     */
    public function bcrypt($password, $cost = 6)
    {
        return password_hash($password,PASSWORD_BCRYPT, [
            'cost' => $cost
        ]);
    }

}
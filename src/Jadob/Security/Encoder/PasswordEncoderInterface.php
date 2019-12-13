<?php

namespace Jadob\Security\Encoder;

/**
 * Interface PasswordEncoderInterface
 *
 * @package Jadob\Security\Encoder
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
interface PasswordEncoderInterface
{

    const MAX_LENGTH = 4096;

    /**
     * @param  string $raw
     * @param  string $hash
     * @return bool
     */
    public function compare($raw, $hash);

    /**
     * @param  string $raw
     * @param  string $salt
     * @return string
     */
    public function encode($raw, $salt = null);

}
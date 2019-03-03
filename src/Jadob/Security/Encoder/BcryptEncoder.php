<?php

namespace Jadob\Security\Encoder;

/**
 * Class BcryptEncoder
 * @package Jadob\Security\Encoder
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class BcryptEncoder extends AbstractPasswordEncoder
{
    /**
     * @var int
     */
    protected $cost;

    /**
     * BcryptEncoder constructor.
     * @param int $cost
     */
    public function __construct(int $cost)
    {
        $this->cost = $cost;
    }

    /**
     * @param string $raw
     * @param string $salt
     * @return bool|string
     */
    public function encode($raw, $salt = null)
    {
        return \password_hash($raw, \PASSWORD_BCRYPT, [
            'cost' => $this->cost
        ]);
    }

    /**
     * @param string $raw
     * @param string $hash
     * @return bool
     */
    public function compare($raw, $hash)
    {
        return \password_verify($raw, $hash);
    }
}
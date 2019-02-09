<?php

namespace Jadob\Security\Exception;

/**
 * Class InvalidCredentialsException
 * @package Jadob\Security\Exception
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class InvalidCredentialsException extends \Error
{
    /**
     * Things passed by used, extracted in
     * @var mixed
     */
    protected $passedCredentials;

    /**
     * @param mixed $passedCredentials
     */
    public function setPassedCredentials($passedCredentials)
    {
        $this->passedCredentials = $passedCredentials;
    }

    /**
     * @return mixed
     */
    public function getPassedCredentials()
    {
        return $this->passedCredentials;
    }
}
<?php

namespace Jadob\Security\Exception;

/**
 * Class InvalidCredentialsException
 *
 * @package Jadob\Security\Exception
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class InvalidCredentialsException extends \Error
{
    /**
     * Things passed by used, extracted in
     *
     * @var mixed
     */
    protected $passedCredentials;

    /**
     * @param mixed $passedCredentials
     *
     * @return void
     */
    public function setPassedCredentials($passedCredentials): void
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
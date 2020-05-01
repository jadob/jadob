<?php
declare(strict_types=1);

namespace Jadob\Security\Auth\Exception;

/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class InvalidCredentialsException extends AuthenticationException
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
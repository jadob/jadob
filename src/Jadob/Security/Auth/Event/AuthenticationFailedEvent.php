<?php

namespace Jadob\Security\Auth\Event;

use Jadob\Security\Auth\Exception\AuthenticationException;
use Jadob\Security\Auth\User\UserInterface;
use Symfony\Component\HttpFoundation\Request;

readonly class AuthenticationFailedEvent
{
    public function __construct(
        protected Request $request,
        protected AuthenticationException $exception
    )
    {
    }

    public function getRequest(): Request
    {
        return $this->request;
    }

    public function getException(): AuthenticationException
    {
        return $this->exception;
    }
}
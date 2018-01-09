<?php

namespace Slice\Security\Auth\Provider;


interface UserProviderInterface
{
    public function loadUserByUsername($username);
}
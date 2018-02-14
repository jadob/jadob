<?php

namespace Jadob\Security\Auth\Provider;


interface UserProviderInterface
{
    public function loadUserByUsername($username);
}
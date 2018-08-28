<?php

namespace Jadob\Security\Auth\Provider;

/**
 * Class UserProviderFactoryInterface
 * @package Jadob\Security\Auth\Provider
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
interface UserProviderFactoryInterface
{

    /**
     * @param array $providerSettings
     * @return UserProviderInterface
     */
    public function create(array $providerSettings): UserProviderInterface;
}
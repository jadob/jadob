<?php
declare(strict_types=1);

namespace Jadob\Security\Auth\Identity;

use Jadob\Security\Auth\User\UserInterface;

/**
 * Use this when you need to refresh your user every request
 * @license MIT
 */
interface RefreshableIdentityProviderInterface
{
    public function refreshIdentity(UserInterface $identity): UserInterface;
}
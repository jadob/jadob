<?php
declare(strict_types=1);

namespace Jadob\Security\Auth\User;

/**
 * In some cases user object should be fetched once again on each request.
 * When your User class needs to be refreshed, just implement this one.
 *
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
interface RefreshableUserInterface
{
    public function getId();
}

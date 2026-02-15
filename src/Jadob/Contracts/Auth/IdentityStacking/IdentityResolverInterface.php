<?php

declare(strict_types=1);

namespace Jadob\Contracts\Auth\IdentityStacking;

use Symfony\Component\HttpFoundation\Request;

/**
 * Picks up the identity the user is currently using (e.g. from path, or cookie).
 * @license MIT
 */
interface IdentityResolverInterface
{
    public function resolve(Request $request): int;
}
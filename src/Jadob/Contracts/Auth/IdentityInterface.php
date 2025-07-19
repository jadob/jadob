<?php

declare(strict_types=1);

namespace Jadob\Contracts\Auth;

/**
 * This interface must be implemented by your User object.
 * @license MIT
 */
interface IdentityInterface
{
    /**
     * Used to retrieve identity object.
     * @return string
     */
    public function getIdentityId(): string;
}
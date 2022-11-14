<?php

declare(strict_types=1);

namespace Jadob\Contracts\Auth\Exception;

/**
 * Thrown when impossible to find our user in persistence layer.
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class IdentityNotFoundException implements AuthExceptionInterface
{

}
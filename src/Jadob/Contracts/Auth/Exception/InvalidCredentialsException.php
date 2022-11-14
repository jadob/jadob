<?php

declare(strict_types=1);

namespace Jadob\Contracts\Auth\Exception;

/**
 * Thrown when there is something bad with credentials given from our user - bad password, invalid client_id etc.
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class InvalidCredentialsException implements AuthExceptionInterface
{

}
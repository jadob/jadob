<?php
declare(strict_types=1);

namespace Jadob\Container\Exception;

use Exception;
use Psr\Container\ContainerExceptionInterface;

/**
 * Class ContainerException
 *
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class ContainerException extends Exception implements ContainerExceptionInterface
{
}
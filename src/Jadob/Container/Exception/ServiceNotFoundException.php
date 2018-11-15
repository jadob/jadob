<?php

namespace Jadob\Container\Exception;

use Exception;
use Psr\Container\NotFoundExceptionInterface;

/**
 * Class ServiceNotFoundException
 * @package Jadob\Container\Exception
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class ServiceNotFoundException extends Exception implements NotFoundExceptionInterface
{

}
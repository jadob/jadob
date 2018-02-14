<?php

namespace Jadob\Cache\Exception;

use Exception;
use Psr\SimpleCache\CacheException as CacheExceptionInterface;

/**
 * Class CacheException
 * @package Jadob\Cache\Exception
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class CacheException extends Exception implements CacheExceptionInterface
{

}
<?php

namespace Slice\Cache\Exception;

use Exception;
use Psr\SimpleCache\CacheException as CacheExceptionInterface;

/**
 * Class CacheException
 * @package Slice\Cache\Exception
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class CacheException extends Exception implements CacheExceptionInterface
{

}
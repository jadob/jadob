<?php

declare(strict_types=1);

namespace Jadob\EventDispatcher;

use function get_class;
use function microtime;
use function spl_object_hash;

/**
 * @license MIT
 */
class Timestamp
{

    protected $className;

    protected $timestamp;

    protected $objectHash;

    public function __construct(string $className, float $timestamp, string $objectHash)
    {
        $this->className = $className;
        $this->timestamp = $timestamp;
        $this->objectHash = $objectHash;
    }

}
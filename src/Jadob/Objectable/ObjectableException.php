<?php
declare(strict_types=1);

namespace Jadob\Objectable;

use Exception;
use Jadob\Objectable\Annotation\Header;

/**
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class ObjectableException extends Exception
{
    /**
     * Thrown when Two headers has the same order value.
     * @param Header $a
     * @param Header $b
     * @return ObjectableException
     */
    public static function sameHeadersOrder(Header $a, Header $b)
    {
        $message = 'Cannot sort headers as Header "%s" has the same order value as header "%s"';
        return new self(
            sprintf($message, $a->getTitle(), $b->getTitle())
        );
    }
}
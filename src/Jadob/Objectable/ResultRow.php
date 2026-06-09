<?php
declare(strict_types=1);

namespace Jadob\Objectable;

use Jadob\Objectable\Annotation\ActionField;

/**
 * @deprecated
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class ResultRow
{
    /**
     * @var ActionField[]
     */
    protected $actionFields = [];

    /**
     * @var array<string, string>
     */
    protected $values = [];
}
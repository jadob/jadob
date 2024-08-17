<?php
declare(strict_types=1);

namespace Jadob\Objectable\Annotation;

use Attribute;

/**
 * Use this annotation on your class to let Objectable know to manage them.
 *
 * @Annotation
 * @Target({"CLASS"})
 *
 * @author pizzaminded <miki@calorietool.com>
 * @license MIT
 */
#[Attribute]
class Row
{
}
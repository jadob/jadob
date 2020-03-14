<?php

declare(strict_types=1);

namespace Jadob\Bridge\Twig\Extension;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * Class DebugExtension
 *
 * @package Jadob\Debug\Twig\Extension
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class DebugExtension extends AbstractExtension
{
    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('r', [$this, 'debug'], ['is_safe' => ['html'],]),
        ];
    }

    public function debug(): ?string
    {
        return @r(\func_get_args());
    }
}
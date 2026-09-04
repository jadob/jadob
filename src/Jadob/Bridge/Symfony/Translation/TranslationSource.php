<?php

declare(strict_types=1);

namespace Jadob\Bridge\Symfony\Translation;

/**
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
final readonly class TranslationSource
{
    public function __construct(
        private(set) string $path,
        private(set) string $locale,
        private(set) string $domain
    ) {
    }
}
<?php

declare(strict_types=1);

namespace Jadob\Bridge\Twig\Extension;

use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

final class TranslationExtension extends AbstractExtension
{
    public function __construct(
        private TranslatorInterface $translator,
    )
    {
    }

    public function getFilters(): array
    {
        return [
            new TwigFilter('trans', [$this, 'translate']),
        ];
    }

    public function translate(
        string $id,
        array $parameters = [],
        ?string $domain = null,
        ?string $locale = null
    ): string
    {
        return $this
            ->translator
            ->trans(
                id: $id,
                parameters: $parameters,
                domain: $domain,
                locale: $locale
            );
    }
}
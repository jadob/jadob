<?php

declare(strict_types=1);

namespace Jadob\Bridge\Twig\Extension;

use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class TranslationExtension extends AbstractExtension
{

    /**
     * @var TranslatorInterface
     */
    protected TranslatorInterface $translator;

    /**
     * TranslationExtension constructor.
     *
     * @param TranslatorInterface $translator
     */
    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return [
            new TwigFilter('trans', [$this, 'translate'], ['is_safe' => ['html']])
        ];
    }


    /**
     * TODO trans() method has more arguments than one
     *
     * @param  $string
     * @return string
     */
    public function translate($string): string
    {
        return $this->translator->trans($string);
    }
}
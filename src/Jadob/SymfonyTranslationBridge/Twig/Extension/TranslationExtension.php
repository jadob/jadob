<?php

declare(strict_types=1);

namespace Jadob\SymfonyTranslationBridge\Twig\Extension;

use Symfony\Component\Translation\Exception\InvalidArgumentException;
use Symfony\Contracts\Translation\TranslatorInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

/**
 * Class TranslationExtension
 * @package Jadob\SymfonyTranslationBridge\Twig\Extension
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class TranslationExtension extends AbstractExtension
{

    /**
     * @var TranslatorInterface
     */
    protected $translator;

    /**
     * TranslationExtension constructor.
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
     * @param $string
     * @return string
     */
    public function translate($string): string
    {
        return $this->translator->trans($string);
    }
}
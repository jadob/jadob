<?php

namespace Jadob\SymfonyTranslationBridge\Twig\Extension;

use Symfony\Component\Translation\Translator;

/**
 * Class TranslationExtension
 * @package Jadob\SymfonyTranslationBridge\Twig\Extension
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class TranslationExtension extends \Twig_Extension
{

    /**
     * @var Translator
     */
    protected $translator;

    /**
     * TranslationExtension constructor.
     * @param Translator $translator
     */
    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @return array
     */
    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter('trans', [$this, 'translate'], ['is_safe' => 'html'])
        ];
    }

    /**
     * @param string $string
     * @return string
     * @throws \Symfony\Component\Translation\Exception\InvalidArgumentException
     */
    public function translate($string)
    {
        return $this->translator->trans($string);
    }
}
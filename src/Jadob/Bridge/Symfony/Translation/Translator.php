<?php
declare(strict_types=1);

namespace Jadob\Bridge\Symfony\Translation;

use Jadob\Contract\Translation\TranslatorInterface;
use Symfony\Component\Translation\Translator as SymfonyTranslator;

/**
 * Symfony Translator component decorated to comply to Jadob translations contract.
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class Translator implements TranslatorInterface
{

    /**
     * @var SymfonyTranslator
     */
    protected SymfonyTranslator $translator;

    /**
     * Translator constructor.
     * @param SymfonyTranslator $translator
     */
    public function __construct($translator)
    {
        $this->translator = $translator;
    }

    /**
     * @param string $key
     * @param array $arguments
     * @param string|null $group
     * @return mixed
     */
    public function translate(string $key, array $arguments = [], string $group = null): string
    {
        // TODO: Implement translate() method.
    }

    /**
     * @param string $locale
     */
    public function setLocale(string $locale): void
    {
        $this->translator->setLocale($locale);
    }

    /**
     * @param string $path
     * @param string $locale
     * @param string $type
     * @param string $group
     * @return mixed
     */
    public function addSource(string $path, string $locale, string $type, string $group): void
    {
        $this->translator->addResource($type, $path, $locale, $group);
    }
}
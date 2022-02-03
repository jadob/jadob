<?php
declare(strict_types=1);

namespace Jadob\Objectable\Transformer;

use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class SymfonyHeaderTransformer implements HeaderTransformerInterface
{
    protected TranslatorInterface $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

    /**
     * @inheritDoc
     */
    public function transform(string $title, string $className, string $propertyName): string
    {
        return $this->translator->trans($title);
    }
}
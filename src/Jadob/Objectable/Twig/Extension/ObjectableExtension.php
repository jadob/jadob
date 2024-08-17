<?php
declare(strict_types=1);

namespace Jadob\Objectable\Twig\Extension;

use Iterator;
use Jadob\Objectable\Objectable;
use Jadob\Objectable\ObjectableException;
use ReflectionException;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

/**
 * @author pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class ObjectableExtension extends AbstractExtension
{
    public function __construct(protected Objectable $objectable)
    {
    }

    /**
     * @return TwigFunction[]
     */
    public function getFunctions(): array
    {
        return [
            new TwigFunction('objectable', $this->renderTable(...), ['is_safe' => ['html']]),
        ];
    }

    /**
     * @param array|Iterator $data
     * @return string
     * @throws ObjectableException
     * @throws ReflectionException
     */
    public function renderTable(array|Iterator $data): string
    {
        return $this->objectable->renderTable($data);
    }
}
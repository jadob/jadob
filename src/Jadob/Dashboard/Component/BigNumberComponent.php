<?php
declare(strict_types=1);

namespace Jadob\Dashboard\Component;

use DateTimeInterface;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\Request;

class BigNumberComponent implements ComponentProviderInterface
{
    protected function process(Request $request, DateTimeInterface $requestDateTime, array $context): float
    {
        if (!isset($context['number'])) {
            throw new InvalidArgumentException('Missing "number" attribute in $context!');
        }
        return $context['number'];
    }

    final public function getData(Request $request, DateTimeInterface $requestDateTime, array $context): array
    {
        return ['number' => $this->process($request, $requestDateTime, $context)];
    }

    final public function getTemplatePath(): string
    {
        return '@JadobDashboard/components/big_number.html.twig';
    }
}
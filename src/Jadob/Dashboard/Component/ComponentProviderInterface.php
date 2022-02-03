<?php
declare(strict_types=1);

namespace Jadob\Dashboard\Component;

use DateTimeInterface;
use Symfony\Component\HttpFoundation\Request;

/**
 * Provides data and template for dashboard component.
 * @license MIT
 */
interface ComponentProviderInterface
{
    public function getData(Request $request, DateTimeInterface $requestDateTime, array $context): array;
    public function getTemplatePath(): string;
}
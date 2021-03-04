<?php
declare(strict_types=1);

namespace Jadob\Dashboard\Bridge\Symfony;

use Jadob\Dashboard\UrlGeneratorInterface as DashboardUrlGeneratorInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface as SymfonyUrlGeneratorInterface;

/**
 * Allows to use jadob/dashboard in Symfony 4+ based apps.
 */
class UrlGenerator implements DashboardUrlGeneratorInterface
{
    protected SymfonyUrlGeneratorInterface $urlGenerator;

    public function __construct(SymfonyUrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    public function generateRoute(string $name, array $params = []): string
    {
        return $this->urlGenerator->generate($name, $params);
    }
}
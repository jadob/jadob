<?php
declare(strict_types=1);

namespace Jadob\Dashboard;

interface UrlGeneratorInterface
{
    public function generateRoute(string $name, array $params = []): string;
}
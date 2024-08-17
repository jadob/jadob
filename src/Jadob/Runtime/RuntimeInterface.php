<?php
declare(strict_types=1);

namespace Jadob\Runtime;

interface RuntimeInterface
{
    /**
     * Should return a string when e.g platform is read-only but provides a special directory for cache files (example: AWS Lambda)
     * In other cases it can return null;
     * @return string|null
     */
    public function getTmpDir(): ?string;

    /**
     * @return string
     */
    public function getVersion(): string;
}
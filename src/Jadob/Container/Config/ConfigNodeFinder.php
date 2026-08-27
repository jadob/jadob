<?php
declare(strict_types=1);

namespace Jadob\Container\Config;

use LogicException;
use function file_exists;
use function rtrim;
use function sprintf;

class ConfigNodeFinder implements ConfigNodeFinderInterface
{
    /**
     * @param array<non-empty-string> $paths sorted ascending by priority
     */
    public function __construct(
        private array $paths = []
    ) {
    }

    public function find(string $node): array
    {
        $result = [];
        foreach ($this->paths as $path) {
            $path = sprintf(
                '%s/%s.php',
                rtrim($path, '/'),
                $node
            );

            if (file_exists($path) === false) {
                continue;
            }

            $config = include $path;

            if (is_object($config) === false) {
                throw new LogicException(
                    sprintf(
                        'Config file in "%s" must return an object.',
                        $path
                    )
                );
            }

            $result[] = $config;
        }

        return $result;
    }
}
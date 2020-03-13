<?php
declare(strict_types=1);

namespace Jadob\Config;

use Jadob\Config\Exception\ConfigNodeNotFoundException;

/**
 * @author  pizzaminded <mikolajczajkowsky@gmail.com>
 * @license MIT
 */
class Config
{

    /**
     * @var array
     */
    protected $nodes = [];

    /**
     * @param string $directory Directory to be scanned
     * @param array $extensions Not implemented yet
     * @param int $level How many levels of subdirectories we need to scan?
     * @param array $parameters Parameters that would be passed to config files
     * @return Config
     */
    public function loadDirectory(
        string $directory,
        array $extensions = [],
        int $level = 1,
        array $parameters = []
    )
    {
        //remove trailing slash
        $directory = \rtrim($directory, '/');
        $subdirectoriesToScan = \str_repeat('/*', $level);
        $files = \glob($directory . $subdirectoriesToScan . '.php');

        foreach ($files as $file) {
            //We assume that file name === config node name
            $configNodeName = \basename($file, '.php');

            //separates config files from current method for prevent variable leaking
            $configResolver = static function ($file, $parameters) {
                //@TODO remove this one as this may be hard for unit testing
                \extract($parameters);


                /** @noinspection PhpIncludeInspection */
                return include $file;
            };

            $this->nodes[$configNodeName] = $configResolver($file, $parameters);
        }


        return $this;
    }

    /**
     * @param string $name
     * @return array
     * @throws ConfigNodeNotFoundException
     */
    public function getNode(string $name): array
    {
        if ($this->hasNode($name)) {
            return $this->nodes[$name];
        }

        throw new ConfigNodeNotFoundException('Could not find node "' . $name . '".');
    }

    /**
     * @param string $name
     * @param mixed $content - preferred array value
     * @return $this
     */
    public function addNode(string $name, $content)
    {
        $this->nodes[$name] = $content;

        return $this;
    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasNode(string $name): bool
    {
        return isset($this->nodes[$name]);
    }

    /**
     * Return all nodes as an array.
     *
     * @return array
     */
    public function toArray(): array
    {
        $output = [];

        foreach ($this->nodes as $nodeName => $node) {
            $output[$nodeName] = $node;
        }

        return $output;
    }
}
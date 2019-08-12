<?php

namespace Jadob\Config;

/**
 * @author pizzaminded <miki@appvende.net>
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
     * @param int $level How many subdirectories we need to scan?
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
            $configResolver = static function($file, $parameters) {
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
     * @return mixed
     */
    public function getNode(string $name)
    {
        return $this->nodes[$name];
    }

    /**
     * @param string $name
     * @param mixed $content - preferred any scalar value
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
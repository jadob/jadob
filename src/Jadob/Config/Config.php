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
     * @param string $directory
     * @param array $extensions
     * @param int $level
     * @return Config
     */
    public function loadDirectory(string $directory, array $extensions = [], int $level = 1)
    {
        //remove trailing slash
        $directory = \rtrim($directory, '/');
        $subdirectoriesToScan = \str_repeat('/*', $level);
        $files = \glob($directory . $subdirectoriesToScan . '.php');

        foreach ($files as $file) {
            //We assume that file name === config node name
            $configNodeName = \basename($file, '.php');

            /** @noinspection PhpIncludeInspection */
            $this->nodes[$configNodeName] = include $file;
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
}
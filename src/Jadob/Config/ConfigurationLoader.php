<?php

namespace Jadob\Config;

class ConfigurationLoader
{

    public function load(
        string $configDirectory,
        string $environment,
    ): ConfigurationCollection
    {
        // glob through the directory
        // find <node>.php and <node>.<$environment>.php
        // load all config nodes to ConfigurationCollection
    }

}
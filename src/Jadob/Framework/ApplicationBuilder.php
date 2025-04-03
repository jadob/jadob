<?php

namespace Jadob\Framework;

use Jadob\Framework\Module\ModuleInterface;

class ApplicationBuilder
{

    /**
     *
     * @var array<string>
     */
    private array $envs = [];

    /**
     * List of PHP extensions required to run.
     * @var list<string>
     */
    private array $phpExtensions = [];

    private array $serviceProviders = [];

    /**
     * @var list<ModuleInterface>
     */
    private array $modules = [];

    public function withConfigDirectory(string $directory): self
    {

    }

    public function withRootDir(string $directory): self
    {

    }

    public function withDotenvFile(string $path): self
    {

    }

    public function withServiceProviders(array $providers): self
    {

    }

    public function withModules(array $modules): self
    {

    }

    public function withEnv(string $key)
    {

    }

    public function withPhpExtension(string $extension): self
    {

    }



}
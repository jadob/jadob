<?php
namespace Slice\Core;


class Environment
{
    const ENV_PRODUCTION = 'prod';
    const ENV_DEVELOPMENT = 'dev';

    protected $environment;

    public function __construct(string $env)
    {
        $this->environment = $this->matchEnvironment(strtolower($env));
    }

    protected function matchEnvironment($env): string
    {
        $environment = self::ENV_DEVELOPMENT;

        if(substr($env, 0, 4) === self::ENV_PRODUCTION) {
            $environment = self::ENV_PRODUCTION;
        }

        return $environment;
    }

    public function isProduction(): bool
    {
        return $this->environment === self::ENV_PRODUCTION;
    }

    /**
     * @return string
     */
    public function getEnvironment(): string
    {
        return $this->environment;
    }


}
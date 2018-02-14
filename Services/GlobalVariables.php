<?php

namespace Jadob\Core\Services;

/**
 * Class GlobalVariables
 * Service name: globals
 * @package Jadob\Core\Services
 * @author pizzaminded <miki@appvende.net>
 * @license MIT
 */
class GlobalVariables
{

    /**
     * @var array
     */
    protected $variables;

    /**
     * GlobalVariables constructor.
     * @param array $variables
     */
    public function __construct($variables)
    {
        $this->variables = $variables;
    }

    /**
     * @param string $variableName
     * @return mixed
     * @throws \RuntimeException
     */
    public function get($variableName)
    {
        if (isset($this->variables[$variableName])) {
            return $this->variables[$variableName];
        }

        throw new \RuntimeException('Global Variable "' . $variableName . '" is not defined');
    }

    /**
     * @param string $variableName
     * @param mixed $value
     * @return $this
     */
    public function set($variableName, $value)
    {
        $this->variables[$variableName] = $value;
        return $this;
    }
}
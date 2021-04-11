<?php
declare(strict_types=1);

namespace Jadob\Dashboard\Configuration;


use Jadob\Dashboard\Exception\ConfigurationException;
use Jadob\Dashboard\Exception\DashboardException;

class EntityOperation
{
    protected string $name;
    protected string $label;
    protected ?string $handlerFqcn = null;
    protected ?string $handlerMethod = null;
    protected ?\Closure $argumentTransformer = null;
    protected bool $forcePersist = false;


    public function __construct(string $name, string $label, ?string $handlerFqcn = null, ?string $handlerMethod = null, ?\Closure $argumentTransformer = null, bool $forcePersist = false)
    {
        if ($handlerFqcn === null && $handlerMethod === null) {
            throw new DashboardException(sprintf('There should be handler FQCN, handler method or both of them defined in "%s" operation', $name));
        }

        $this->name = $name;
        $this->label = $label;
        $this->handlerFqcn = $handlerFqcn;
        $this->handlerMethod = $handlerMethod;
        $this->argumentTransformer = $argumentTransformer;
        $this->forcePersist = $forcePersist;

    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @return string|null
     */
    public function getHandlerFqcn(): ?string
    {
        return $this->handlerFqcn;
    }

    /**
     * @return string|null
     */
    public function getHandlerMethod(): ?string
    {
        return $this->handlerMethod;
    }

    /**
     * @return \Closure|null
     */
    public function getArgumentTransformer(): ?\Closure
    {
        return $this->argumentTransformer;
    }

    /**
     * @return bool
     */
    public function isForcePersist(): bool
    {
        return $this->forcePersist;
    }

    /**
     * @param string $name
     * @param array $config
     * @return EntityOperation
     * @throws ConfigurationException
     * @throws DashboardException
     */
    public static function fromArray(string $name, array $config): EntityOperation
    {
        if (!isset($config['label'])) {
            throw new ConfigurationException(sprintf('There is no "label" key for "%s" operation!', $name));
        }

        if (!is_string($config['label'])) {
            throw new ConfigurationException(sprintf('"label" value for "%s" operation must be an string!', $name));
        }

        if (isset($config['force_persist']) && !is_bool($config['force_persist'])) {
            throw new ConfigurationException(sprintf('Value for "force_persist" key for "%s" operation must be a bool!', $name));
        }

        if (isset($config['handler_fqcn']) && !(is_string($config['handler_fqcn']) || is_null($config['handler_fqcn']))) {
            throw new ConfigurationException(sprintf('Value for "force_persist" key for "%s" operation must be a string or null!', $name));
        }

        return new self(
            $name,
            $config['label'],
            $config['handler_fqcn'] ?? null,
            $config['handler_method'] ?? null,
            $config['transform'] ?? null,
            $config['force_persist'] ?? false
        );
    }
}
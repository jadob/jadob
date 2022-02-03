<?php
declare(strict_types=1);

namespace Jadob\Dashboard\Configuration;

use Jadob\Dashboard\Exception\ConfigurationException;

class PredefinedCriteria
{
    protected string $name;
    protected string $method;
    protected string $label;
    protected bool $customResultSet = false;

    public static function create(string $name, array $config): self
    {
        $propsToCheck = ['method', 'label'];

        foreach ($propsToCheck as $propToCheck) {
            if (!array_key_exists($propToCheck,$config)) {
                throw new ConfigurationException(sprintf('Missing "%s" key in "%s" criteria!', $propToCheck, $name));
            }

            if (!is_string($config[$propToCheck])) {
                throw new ConfigurationException(sprintf('Value passed to "%s" key in "%s" criteria is not a string!', $propToCheck, $name));
            }
        }

        $self = new self();
        $self->name = $name;
        $self->method = $config['method'];
        $self->label = $config['label'];

        if (isset($config['custom_result_set']) && is_bool($config['custom_result_set'])) {
            $self->customResultSet = $config['custom_result_set'];
        }

        return $self;
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
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @return bool
     */
    public function isCustomResultSet(): bool
    {
        return $this->customResultSet;
    }
}
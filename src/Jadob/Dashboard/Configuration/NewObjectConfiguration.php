<?php
declare(strict_types=1);


namespace Jadob\Dashboard\Configuration;

use Closure;
use Jadob\Dashboard\Exception\ConfigurationException;

class NewObjectConfiguration
{
    protected ?Closure $formFactory = null;
    protected ?string $formClass = null;
    protected ?Closure $beforeInsert = null;
    protected ?Closure $formTransformHook = null;


    private function __construct()
    {
    }

    /**
     * @param array $config
     * @return NewObjectConfiguration
     * @throws ConfigurationException
     */
    public static function fromArray(array $config): self
    {
        if (!isset($config['form_factory']) && !isset($config['form_class'])) {
            throw new ConfigurationException('Missing "form_factory" or "form_class" entry for new object configuration.');
        }

        if (isset($config['form_class']) && isset($config['form_factory'])) {
            throw new ConfigurationException('Cannot use both "form_factory" and "form_class" for new object configuration!');
        }

        if (isset($config['before_insert']) && !($config['before_insert'] instanceof Closure)) {
            throw new ConfigurationException('Could not use before_insert hook as it is not a closure!');
        }

        if (isset($config['form_transform_hook']) && !($config['form_transform_hook'] instanceof Closure)) {
            throw new ConfigurationException('Could not use form_transform_hook as it is not a closure!');
        }

        if (isset($config['form_factory']) && !($config['form_factory'] instanceof Closure)) {
            throw new ConfigurationException('Value of "form_factory" must be a closure!');
        }

        if (isset($config['form_class']) && !is_string($config['form_class'])) {
            throw new ConfigurationException('Value of "form_class" must be a string!');
        }


        $self = new self();
        $self->formFactory = $config['form_factory'] ?? null;
        $self->formClass = $config['form_class'] ?? null;
        $self->beforeInsert = $config['before_insert'] ?? null;
        $self->formTransformHook = $config['form_transform_hook'] ?? null;
        return $self;
    }

    /**
     * @return Closure|null
     */
    public function getBeforeInsertHook(): ?Closure
    {
        return $this->beforeInsert;
    }

    public function hasBeforeInsertHook(): bool
    {
        return $this->beforeInsert !== null;
    }

    public function hasFormTransformHook(): bool
    {
        return $this->formTransformHook !== null;
    }

    /**
     * @return Closure|null
     */
    public function getFormTransformHook(): ?Closure
    {
        return $this->formTransformHook;
    }


    /**
     * @return Closure|null
     */
    public function getFormFactory(): ?Closure
    {
        return $this->formFactory;
    }

    /**
     * @return string|null
     */
    public function getFormClass(): ?string
    {
        return $this->formClass;
    }
}
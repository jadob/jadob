<?php


namespace Jadob\Dashboard\Configuration;


use Closure;
use Jadob\Dashboard\Exception\ConfigurationException;

class NewObjectConfiguration
{
    protected \Closure $formFactory;
    protected ?\Closure $beforeInsert = null;

    /**
     * @return \Closure
     */
    public function getFormFactory(): \Closure
    {
        return $this->formFactory;
    }


    public static function fromArray(array $config): self
    {
        if(!isset($config['form_factory'])) {
            throw new ConfigurationException('Missing "form_factory" entry for new object configuration.');
        }

        if (isset($config['before_insert']) && !($config['before_insert'] instanceof Closure)) {
            throw new ConfigurationException('Could not use before_insert hook as it is not a closure!');
        }

        $self = new self();
        $self->formFactory = $config['form_factory'];
        return $self;
    }

    /**
     * @return \Closure|null
     */
    public function getBeforeInsertHook(): ?\Closure
    {
        return $this->beforeInsert;
    }

    public function hasBeforeInsertHook(): bool
    {
        return $this->beforeInsert !== null;
    }

}
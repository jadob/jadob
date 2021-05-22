<?php
declare(strict_types=1);

namespace Jadob\Dashboard\Configuration;


class ActionConfiguration
{

    protected string $path;

    protected string $label;

    public static function fromArray(array $config): ActionConfiguration
    {
        $self = new self();
        $self->label = $config['label'];
        $self->path = $config['path'];
        return $self;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

}
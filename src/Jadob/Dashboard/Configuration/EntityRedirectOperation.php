<?php
declare(strict_types=1);

namespace Jadob\Dashboard\Configuration;


class EntityRedirectOperation
{

    protected string $name;
    protected string $label;
    protected string $path;
    protected ?\Closure $argumentTransformer = null;



    public function __construct(string $name, string $label, string $path, ?\Closure $argumentTransformer = null)
    {

        $this->name = $name;
        $this->label = $label;
        $this->path = $path;
        $this->argumentTransformer = $argumentTransformer;
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
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @return \Closure|null
     */
    public function getArgumentTransformer(): ?\Closure
    {
        return $this->argumentTransformer;
    }

}
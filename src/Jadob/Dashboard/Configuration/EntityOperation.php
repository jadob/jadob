<?php
declare(strict_types=1);

namespace Jadob\Dashboard\Configuration;


use Jadob\Dashboard\Exception\DashboardException;

class EntityOperation
{
    protected string $name;
    protected string $label;
    protected ?string $handlerFqcn = null;
    protected ?string $handlerMethod = null;
    protected ?\Closure $argumentTransformer = null;


    public function __construct(string $name, string $label, ?string $handlerFqcn = null, ?string $handlerMethod = null, ?\Closure $argumentTransformer = null)
    {
        if($handlerFqcn === null && $handlerMethod === null) {
            throw new DashboardException(sprintf('There should be handler FQCN, handler method or both of them defined in "%s" operation', $name));
        }

        $this->name = $name;
        $this->label = $label;
        $this->handlerFqcn = $handlerFqcn;
        $this->handlerMethod = $handlerMethod;
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
}
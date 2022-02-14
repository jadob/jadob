<?php
declare(strict_types=1);

namespace Jadob\Objectable\Annotation;

#[\Attribute(\Attribute::IS_REPEATABLE | \Attribute::TARGET_PROPERTY)]
class Field
{

    public function __construct(
        protected string $name,
        protected int $order,
        protected array $context = [],
        protected bool $stringable = false,
        protected bool $flat = false,
        protected ?string $flatProperty = null
    )
    {}

    /**
     * @return array
     */
    public function getContext(): array
    {
        return $this->context;
    }

    public function hasContext(string $context): bool
    {
        return \in_array($context, $this->context, true);
    }

    /**
     * @return bool
     */
    public function isStringable(): bool
    {
        return $this->stringable;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return bool
     */
    public function isFlat(): bool
    {
        return $this->flat;
    }

    /**
     * @return string|null
     */
    public function getFlatProperty(): ?string
    {
        return $this->flatProperty;
    }



}
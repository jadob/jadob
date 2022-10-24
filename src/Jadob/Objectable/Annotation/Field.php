<?php
declare(strict_types=1);

namespace Jadob\Objectable\Annotation;

#[\Attribute(\Attribute::IS_REPEATABLE | \Attribute::TARGET_PROPERTY)]
class Field
{

    public function __construct(
        protected string $name,
        /**
         * @deprecated - this seems kinda useless, so maybe make it optional?
         * No one cares about field order in JSON.
         * @var int
         */
        protected int $order,
        protected array $context = ['default'],
        protected bool $stringable = false,
        protected bool $flat = false,
        protected ?string $flatProperty = null,
        protected ?string $dateFormat = null
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

    /**
     * @return string|null
     */
    public function getDateFormat(): ?string
    {
        return $this->dateFormat;
    }
}
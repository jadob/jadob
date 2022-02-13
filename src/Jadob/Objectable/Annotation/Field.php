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
        protected bool $stringable = false
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


}
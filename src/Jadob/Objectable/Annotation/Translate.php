<?php
declare(strict_types=1);

namespace Jadob\Objectable\Annotation;

/**
 * Applies transformation to your output value.
 */
#[\Attribute(\Attribute::IS_REPEATABLE | \Attribute::TARGET_PROPERTY)]
class Translate
{
    public function __construct(
        protected string|int $when,
        protected string|int $then,
        protected array $context = [],
    )
    {}

    public function getWhen(): int|string
    {
        return $this->when;
    }

    public function getContext(): array
    {
        return $this->context;
    }

    /**
     * @return int|string
     */
    public function getThen(): int|string
    {
        return $this->then;
    }






}
<?php
declare(strict_types=1);

namespace Jadob\Container\Builder;

class NamespaceScanConfigurator
{
    /**
     * @var list<class-string>
     */
    private(set) array $fqcnsToExclude = [];

    /**
     * @var array<class-string>
     */
    private(set) array $attributesToMatch = [];

    /**
     * @var array<string>
     */
    private(set) array $paths = [];

    private(set) ?string $suffix = null;
    
    private(set) ?bool $autowire = null;

    /**
     * @var array<string>
     */
    private(set) array $tags = [];

    public function in(string ...$paths): self
    {
        $this->paths += $paths;

        return $this;
    }

    /**
     * @param class-string $attribute
     * @return self
     */
    public function markedWith(string $attribute): self
    {
        $this->attributesToMatch[] = $attribute;

        return $this;
    }

    public function withClassNameSuffix(string $suffix): self
    {
        $this->suffix = $suffix;

        return $this;
    }

    public function excludeClasses(string ...$fqcns): self
    {
        $this->fqcnsToExclude += $fqcns;

        return $this;
    }

    public function withTag(string $tag): self
    {
        $this->tags[] = $tag;

        return $this;
    }

    public function autowire(): self
    {
        $this->autowire = true;
        
        return $this;
    }
}
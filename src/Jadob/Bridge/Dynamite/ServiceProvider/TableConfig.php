<?php
declare(strict_types=1);

namespace Jadob\Bridge\Dynamite\ServiceProvider;

final class TableConfig
{
    /**
     * @param string $name
     * @param string $partitionKeyName
     * @param string $sortKeyName
     * @param array<class-string> $managedObjects
     */
    public function __construct(
        private(set) ?string $name = null,
        private(set) ?string $partitionKeyName = null,
        private(set) ?string $sortKeyName = null,
        private(set) array $managedObjects = []
    ) {
    }

    public function withName(
        string $name,
    ): self {
        $this->name = $name;

        return $this;
    }

    public function withPartitionKeyName(
        string $partitionKeyName,
    ): self {
        $this->partitionKeyName = $partitionKeyName;

        return $this;
    }

    public function withSortKeyName(
        string $sortKeyName,
    ): self {
        $this->sortKeyName = $sortKeyName;

        return $this;
    }

    public function withManagedObject(
        string $managedObject,
    ): self {
        $this->managedObjects[] = $managedObject;

        return $this;
    }
}
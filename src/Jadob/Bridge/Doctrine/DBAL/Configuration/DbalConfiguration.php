<?php

namespace Jadob\Bridge\Doctrine\DBAL\Configuration;

class DbalConfiguration
{
    /**
     * @var array<string, class-string>
     */
    private array $types = [];

    /**
     * @var array<string, string>
     */
    private array $mappingTypes = [];

    /**
     * @var array<string, array{
     *          configuration: string[],
     *          default: bool
     *     }>
     */
    private array $connections = [];

    public function addType(string $name, string $type): self
    {
        $this->types[$name] = $type;
        return $this;
    }

    public function addConnection(
        string $name,
        array  $configuration,
        bool   $default = true
    ): self
    {

        $this->connections[$name] = [
            'configuration' => $configuration,
            'default' => $default,
        ];

        return $this;
    }


    public function addMappingType(string $name, string $type): self
    {
        $this->mappingTypes[$name] = $type;
        return $this;
    }

    public function getTypes(): array
    {
        return $this->types;
    }

    public function getConnections(): array
    {
        return $this->connections;
    }

    public function getMappingTypes(): array
    {
        return $this->mappingTypes;
    }

}
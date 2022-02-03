<?php
declare(strict_types=1);

namespace Jadob\Dashboard\Configuration;

class Grid
{

    /**
     * @var Component[]
     */
    protected array $components = [];

    /**
     * @param array $data
     * @return static
     */
    public static function fromArray(array $data): self
    {
        $self = new self();
        foreach ($data as $component) {
            $self->components[] = new Component(
                $component['title'],
                $component['provider'],
                $component['span'] ?? null,
                $component['context'] ?? []
            );
        }

        return $self;
    }


    /**
     * @return Component[]
     */
    public function getComponents(): array
    {
        return $this->components;
    }
}
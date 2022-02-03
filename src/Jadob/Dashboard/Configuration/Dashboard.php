<?php
declare(strict_types=1);

namespace Jadob\Dashboard\Configuration;

class Dashboard
{
    protected string $name;
    protected Grid $grid;
    protected string $title;

    public function __construct(string $name, Grid $grid, string $title)
    {
        $this->name = $name;
        $this->grid = $grid;
        $this->title = $title;
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
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return Grid
     */
    public function getGrid(): Grid
    {
        return $this->grid;
    }
}
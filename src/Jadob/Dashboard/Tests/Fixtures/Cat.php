<?php
declare(strict_types=1);

namespace Jadob\Dashboard\Tests\Fixtures;


class Cat
{

    protected string $name;
    protected string $breed;

    public function __construct(string $name, string $breed)
    {
        $this->name = $name;
        $this->breed = $breed;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Cat
     */
    public function setName(string $name): Cat
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getBreed(): string
    {
        return $this->breed;
    }

    /**
     * @param string $breed
     * @return Cat
     */
    public function setBreed(string $breed): Cat
    {
        $this->breed = $breed;
        return $this;
    }


    public function meow(): void
    {

    }

    public function woof(): void
    {
        throw new \RuntimeException('am i a joke to you?');
    }

    public function feed(Tuna $tuna)
    {

    }
}
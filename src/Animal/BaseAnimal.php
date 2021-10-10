<?php

namespace Zoo\Animal;

use Zoo\Chip\Chip;

abstract class BaseAnimal implements IBaseAnimal
{
    protected ?Chip $chip;
    private float $weight;
    protected string $call;

    public function __construct(float $weight)
    {
        $this->weight = $weight;
        $this->chip = null;
    }

    public function getChip(): Chip
    {
        return $this->chip;
    }

    public function setChip(Chip $chip): void
    {
        $this->chip = $chip;
    }

    public function getWeight(): float
    {
        return $this->weight;
    }

    public function getCall(): string
    {
        return $this->call;
    }
}

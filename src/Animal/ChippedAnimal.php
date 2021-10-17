<?php

namespace Zoo\Animal;

use Zoo\Chip\Chip;

class ChippedAnimal
{
    private BaseAnimal $animal;
    private Chip $chip;

    public function __construct(BaseAnimal $animal, Chip $chip)
    {
        $this->animal = $animal;
        $this->chip = $chip;
    }

    public function getAnimal(): BaseAnimal
    {
        return $this->animal;
    }

    public function getChip(): Chip
    {
        return $this->chip;
    }
}


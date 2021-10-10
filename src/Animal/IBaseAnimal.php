<?php

namespace Zoo\Animal;

use Zoo\Chip\Chip;

interface IBaseAnimal
{
    public function getChip(): Chip;

    public function setChip(Chip $chip): void;

    public function getWeight(): float;

    public function getCall(): string;
}

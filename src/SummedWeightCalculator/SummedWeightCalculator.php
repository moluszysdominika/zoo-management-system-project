<?php

namespace Zoo\SummedWeightCalculator;

class SummedWeightCalculator implements ISummedWeightCalculator
{
    public function calculateAllAnimalsSummedWeight(array $animals, ?string $excludedSpecies = null): int
    {
        $summedWeight = 0;

        foreach ($animals as $animal) {
            if ($animal->getChip()->getSpecies() === $excludedSpecies) {
                continue;
            }
            $summedWeight += $animal->getAnimal()->getWeight();
        }

        return $summedWeight;
    }
}

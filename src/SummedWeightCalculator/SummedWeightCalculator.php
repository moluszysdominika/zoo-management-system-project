<?php

namespace Zoo\SummedWeightCalculator;
use Zoo\Animal\Employee;



class SummedWeightCalculator implements ISummedWeightCalculator
{
    public function calculateAllAnimalsSummedWeight(array $animals): int
    {
        $summedWeight = 0;

        foreach ($animals as $animal) {
            $summedWeight += $animal->getWeight();
        }

        return $summedWeight;
    }

    public function calculateAllAnimalsSummedWeightWithoutHumans(array $animals): int
    {
        $summedWeight = 0;

        foreach ($animals as $animal) {
            if ($animal->getChip()->getSpecies() !== Employee::getSpecies()) {
                $summedWeight += $animal->getWeight();
            }
        }

        return $summedWeight;
    }
}
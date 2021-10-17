<?php

namespace Zoo\SummedWeightCalculator;

interface ISummedWeightCalculator
{
    public function calculateAllAnimalsSummedWeight(array $animals, ?string $excludedSpecies = null): int;
}

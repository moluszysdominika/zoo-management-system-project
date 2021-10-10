<?php

namespace Zoo\SummedWeightCalculator;

interface ISummedWeightCalculator
{
    public function calculateAllAnimalsSummedWeight(array $animals): int;
    public function calculateAllAnimalsSummedWeightWithoutHumans(array $animals): int;
}

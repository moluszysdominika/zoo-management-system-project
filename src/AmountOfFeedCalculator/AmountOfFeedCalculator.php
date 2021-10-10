<?php

namespace Zoo\AmountOfFeedCalculator;

use Zoo\SummedWeightCalculator\ISummedWeightCalculator;

class AmountOfFeedCalculator implements IAmountOfFeedCalculator
{
    private ISummedWeightCalculator $summedWeightCalculator;

    public function __construct(ISummedWeightCalculator $summedWeightCalculator)
    {
        $this->summedWeightCalculator = $summedWeightCalculator;
    }

    public function calculateAmountOfFeed(array $animals, int $numberOfDays): string
    {
        $summedWeight = $this->summedWeightCalculator->calculateAllAnimalsSummedWeightWithoutHumans($animals);

        return ($numberOfDays * $summedWeight) / 30;
    }
}

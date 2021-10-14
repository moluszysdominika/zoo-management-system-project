<?php

namespace Zoo\AmountOfFeedCalculator;

interface IAmountOfFeedCalculator
{
    public function calculateAmountOfFeed(array $animals, int $numberOfDays, ?string $excludedSpecies = null): string;
}

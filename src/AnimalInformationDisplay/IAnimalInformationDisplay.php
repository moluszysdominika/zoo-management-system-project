<?php

namespace Zoo\AnimalInformationDisplay;

use Zoo\Animal\ChippedAnimal;

interface IAnimalInformationDisplay
{
    public function displayInformationForAnimal(ChippedAnimal $chippedAnimal): string;
    public function displayAmountOfFeed(int $numberOfDays, float $amountOfFeed): string;
}

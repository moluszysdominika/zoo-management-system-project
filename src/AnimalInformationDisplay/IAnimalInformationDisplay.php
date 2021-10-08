<?php

namespace Zoo\AnimalInformationDisplay;
use Zoo\Animal\IBaseAnimal;



interface IAnimalInformationDisplay
{
    public function displayInformationForAnimal(IBaseAnimal $animal): string;
    public function displayAmountOfFeed(int $numberOfDays, float $amountOfFeed): string;
}
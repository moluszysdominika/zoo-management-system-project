<?php

namespace Zoo\AnimalInformationDisplay;

use Zoo\Animal\IBaseAnimal;

class EnglishAnimalInformationDisplay implements IAnimalInformationDisplay
{
    public function displayInformationForAnimal(IBaseAnimal $animal): string
    {
        $animalChip = $animal->getChip();
        $animalName = $animal->getChip()->getName();

        $text = "This is $animalName. $animalName is a {$animalChip->getSpecies()}. $animalName is 
        {$animalChip->getAge()} years old. $animalName, give a voice! {$animal->getCall()} $animalName's 
        ID number is {$animalChip->getIdNumber()}. $animalName came to the Zoo in 
        {$animalChip->getAdmissionDate()}. ";

        return $text;
    }

    public function displayAmountOfFeed(int $numberOfDays, float $amountOfFeed): string
    {
        $text = "The amount of food needed for all animals in the Zoo for $numberOfDays days is $amountOfFeed kg.";

        return $text;
    }
}

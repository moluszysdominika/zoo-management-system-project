<?php

namespace Zoo\AnimalInformationDisplay;

use Zoo\Animal\ChippedAnimal;

class EnglishAnimalInformationDisplay implements IAnimalInformationDisplay
{
    public function displayInformationForAnimal(ChippedAnimal $chippedAnimal): string
    {
        $animalChip = $chippedAnimal->getChip();
        $animalName = $animalChip->getName();

        $text = "This is $animalName. $animalName is a {$animalChip->getSpecies()}. $animalName is 
        {$animalChip->getAge()} years old. $animalName, give a voice! {$chippedAnimal->getAnimal()->getCall()} $animalName's 
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

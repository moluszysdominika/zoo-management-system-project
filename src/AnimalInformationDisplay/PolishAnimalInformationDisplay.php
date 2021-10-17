<?php

namespace Zoo\AnimalInformationDisplay;

use Zoo\Animal\ChippedAnimal;

class PolishAnimalInformationDisplay implements IAnimalInformationDisplay
{
    public function displayInformationForAnimal(ChippedAnimal $chippedAnimal): string
    {
        $animalChip = $chippedAnimal->getChip();
        $animalName = $animalChip->getName();

        $text = "To jest $animalName. $animalName jest {$animalChip->getSpecies()}. $animalName 
            ma {$animalChip->getAge()} lat. $animalName, daj głos! {$chippedAnimal->getAnimal()->getCall()} $animalName 
            ma numer identyfikacyjny {$animalChip->getIdNumber()}. $animalName przybył do ZOO 
            {$animalChip->getAdmissionDate()}. ";

        return $text;
    }

    public function displayAmountOfFeed(int $numberOfDays, float $amountOfFeed): string
    {
        $text = "Ilość karmy potrzebna dla wszystkich zwierząt w Zoo na $numberOfDays dni to: $amountOfFeed kg.";

        return $text;
    }
}

<?php

namespace Zoo\Service;
use DateTime;
use Exception;
use Zoo\AmountOfFeedCalculator\AmountOfFeedCalculator;
use Zoo\AmountOfFeedCalculator\IAmountOfFeedCalculator;
use Zoo\Animal\BaseAnimal;
use Zoo\Animal\Boar;
use Zoo\Animal\Cat;
use Zoo\Animal\Dog;
use Zoo\Animal\Employee;
use Zoo\Animal\IBaseAnimal;
use Zoo\AnimalInformationDisplay\EnglishAnimalInformationDisplay;
use Zoo\AnimalInformationDisplay\IAnimalInformationDisplay;
use Zoo\AnimalInformationDisplay\PolishAnimalInformationDisplay;
use Zoo\Chip\Chip;
use Zoo\SummedWeightCalculator\ISummedWeightCalculator;
use Zoo\SummedWeightCalculator\SummedWeightCalculator;



class Zoo
{
    protected array $animals = [];
    private IAnimalInformationDisplay $animalInformationDisplay;
    private IAmountOfFeedCalculator $amountOfFeedCalculator;
    private ISummedWeightCalculator $summedWeightCalculator;


    public function __construct(IAnimalInformationDisplay $animalInformationDisplay, IAmountOfFeedCalculator $amountOfFeedCalculator, ISummedWeightCalculator $summedWeightCalculator)
    {
        $this->animalInformationDisplay = $animalInformationDisplay;
        $this->amountOfFeedCalculator = $amountOfFeedCalculator;
        $this->summedWeightCalculator = $summedWeightCalculator;
    }

    private function hasAnimalWithId(string $IdNumber): bool
    {
        foreach($this->animals as $animal) {
            if($animal->getChip()->getIdNumber() === $IdNumber) {
                return true;
            }
        }

        return false;
    }

    public function addAnimal(BaseAnimal $animal, Chip $chip): void
    {
        if($this->hasAnimalWithId($chip->getIdNumber())) {
            throw new Exception("Zwierzę o ID " . $chip->getIdNumber() . " już znajduje się w Zoo!");
        }

        $animal->setChip($chip);
        $this->animals[] = $animal;
    }

    private function findAnimalById(string $IdNumber): IBaseAnimal
    {
        foreach($this->animals as $animal) {
            if($animal->getChip()->getIdNumber() === $IdNumber) {
                return $animal;
            }
        }

        throw new Exception("Nie znaleziono zwierzęcia o ID " . $IdNumber);
    }

    public function showAnimal($IdNumber): string
    {
        $animal = $this->findAnimalById($IdNumber);

        return $this->animalInformationDisplay->displayInformationForAnimal($animal);
    }

    public function showAllAnimals(): string
    {
        $allAnimals = $this->animals;

        $text = "";

        foreach ($allAnimals as $animal) {
            $text .= $this->animalInformationDisplay->displayInformationForAnimal($animal) . "\n";
        }

        return $text;
    }

    public function showAllAnimalsBySpecies(string $species): string
    {
        $allAnimals = $this->animals;

        $text = "";

        foreach ($allAnimals as $animal) {
            if ($animal->getChip()->getSpecies() !== $species) {
                continue;
            }
            $text .= $this->animalInformationDisplay->displayInformationForAnimal($animal) . "\n";
        }

        return $text;
    }

    private function findAnimalKeyById(string $IdNumber): int
    {
        foreach($this->animals as $key => $animal) {
            if($animal->getChip()->getIdNumber() === $IdNumber) {
                return $key;
            }
        }

        throw new Exception("Nie znaleziono zwierzęcia o ID " . $IdNumber);
    }

    public function removeAnimal($IdNumber): void
    {
        $animal = $this->findAnimalById($IdNumber);
        unset($this->animals[$this->findAnimalKeyById($IdNumber)]);
    }

    public function getAllAnimalsSummedWeight(): int
    {
        return $this->summedWeightCalculator->calculateAllAnimalsSummedWeight($this->animals);
    }

    public function calculateAmountOfFeedForAnimals(int $numberOfDays) : string
    {
        $amountOfFeed = $this->amountOfFeedCalculator->calculateAmountOfFeed($this->animals, $numberOfDays);

        return $this->animalInformationDisplay->displayAmountOfFeed($numberOfDays, $amountOfFeed);
    }
}
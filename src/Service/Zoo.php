<?php

namespace Zoo\Service;

use Exception;
use Zoo\AmountOfFeedCalculator\IAmountOfFeedCalculator;
use Zoo\Animal\BaseAnimal;
use Zoo\Animal\IBaseAnimal;
use Zoo\AnimalInformationDisplay\IAnimalInformationDisplay;
use Zoo\Chip\Chip;
use Zoo\SummedWeightCalculator\ISummedWeightCalculator;

class Zoo
{
    protected array $animals = [];
    private IAnimalInformationDisplay $animalInformationDisplay;
    private IAmountOfFeedCalculator $amountOfFeedCalculator;
    private ISummedWeightCalculator $summedWeightCalculator;

    public function __construct(
        IAnimalInformationDisplay $animalInformationDisplay,
        IAmountOfFeedCalculator $amountOfFeedCalculator,
        ISummedWeightCalculator $summedWeightCalculator
    ) {
        $this->animalInformationDisplay = $animalInformationDisplay;
        $this->amountOfFeedCalculator = $amountOfFeedCalculator;
        $this->summedWeightCalculator = $summedWeightCalculator;
    }

    private function hasAnimalWithId(string $IdNumber): bool
    {
        foreach ($this->animals as $animal) {
            if ($animal->getChip()->getIdNumber() === $IdNumber) {
                return true;
            }
        }

        return false;
    }

    public function addAnimal(BaseAnimal $animal, Chip $chip): void
    {
        $chip->setSpecies($animal::getSpecies());

        if ($this->hasAnimalWithId($chip->getIdNumber())) {
            throw new Exception("Zwierzę o ID " . $chip->getIdNumber() . " już znajduje się w Zoo!");
        }

        $animal->setChip($chip);
        $this->animals[] = $animal;
    }

    private function showAnimalInformation(IBaseAnimal $animal): string
    {
        return $this->animalInformationDisplay->displayInformationForAnimal($animal);
    }

    private function showAllAnimalsInfromation(array $animals): string
    {
        $text = "";

        foreach ($animals as $animal) {
            $text .= $this->showAnimalInformation($animal) . "\n";
        }

        return $text;
    }

    private function findAnimalById(string $IdNumber): IBaseAnimal
    {
        foreach ($this->animals as $animal) {
            if ($animal->getChip()->getIdNumber() === $IdNumber) {
                return $animal;
            }
        }

        throw new Exception("Nie znaleziono zwierzęcia o ID " . $IdNumber);
    }

    public function showAnimal($IdNumber): string
    {
        $animal = $this->findAnimalById($IdNumber);

        return $this->showAnimalInformation($animal);
    }

    public function showAllAnimals(): string
    {
        return $this->showAllAnimalsInfromation($this->animals);
    }

    public function showAllAnimalsBySpecies(string $species): string
    {
        $filteredAnimals = array_filter($this->animals, fn (IBaseAnimal $animal) => $animal->getSpecies() === $species);

        return $this->showAllAnimalsInfromation($filteredAnimals);
    }

    private function findAnimalKeyById(string $IdNumber): int
    {
        foreach ($this->animals as $key => $animal) {
            if ($animal->getChip()->getIdNumber() === $IdNumber) {
                return $key;
            }
        }

        throw new Exception("Nie znaleziono zwierzęcia o ID " . $IdNumber);
    }

    public function removeAnimal($IdNumber): void
    {
        unset($this->animals[$this->findAnimalKeyById($IdNumber)]);
    }

    public function getAllAnimalsSummedWeight(): int
    {
        return $this->summedWeightCalculator->calculateAllAnimalsSummedWeight($this->animals);
    }

    public function calculateAmountOfFeedForAnimals(int $numberOfDays, ?string $excludedSpecies = null): string
    {
        $amountOfFeed = $this->amountOfFeedCalculator->calculateAmountOfFeed($this->animals, $numberOfDays, $excludedSpecies);

        return $this->animalInformationDisplay->displayAmountOfFeed($numberOfDays, $amountOfFeed);
    }
}

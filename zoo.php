<?php


interface IBaseAnimal
{
    public function getChip(): Chip;

    public function setChip(Chip $chip): void;

    public function getWeight(): float;

    public function getCall(): string;
}

interface IAnimalInformationDisplay
{
    public function displayInformationForAnimal(IBaseAnimal $animal): string;
    public function displayAmountOfFeed(int $numberOfDays, float $amountOfFeed): string;
}

interface ISummedWeightCalculator
{
    public function calculateAllAnimalsSummedWeight(array $animals): int;
}

interface IAmountOfFeedCalculator
{
    public function calculateAmountOfFeed(array $animals, int $numberOfDays): string;
}


class Chip
{
    private string $IdNumber;
    private string $name;
    private DateTime $birthDate;
    private string $species;
    private DateTime $admissionDate;

    public function __construct(string $IdNumber, string $name, DateTime $birthDate, string $species)
    {
        $this->IdNumber = $IdNumber;
        $this->name = $name;
        $this->birthDate = $birthDate;
        $this->species = $species;
        $this->admissionDate = new DateTime();
    }

    public function getIdNumber(): string
    {
        return $this->IdNumber;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getAge(): int
    {
        $date = new DateTime();
        return $this->birthDate->diff($date)->y;
    }

    public function getSpecies(): string
    {
        return $this->species;
    }

    public function getAdmissionDate(): string
    {
        return $this->admissionDate->format("d/m/Y H:i:s");
    }
}


abstract class BaseAnimal implements IBaseAnimal
{
    protected ?Chip $chip;
    private float $weight;
    protected string $call;

    public function __construct(float $weight)
    {
        $this->weight = $weight;
        $this->chip = null;
    }

    public function getChip(): Chip
    {
        return $this->chip;
    }

    public function setChip(Chip $chip): void
    {
        $this->chip = $chip;
    }

    public function getWeight(): float
    {
        return $this->weight;
    }

    public function getCall(): string
    {
        return $this->call;
    }
}

class Cat extends BaseAnimal
{
    protected string $call = "Meow!";

}

class Dog extends BaseAnimal
{
    protected string $call = "Woof!";
}

class Boar extends BaseAnimal
{
    protected string $call = "Oink!";
}

class Employee extends BaseAnimal
{
    protected string $call = "Wreee!";
}

class SummedWeightCalculator implements ISummedWeightCalculator
{
    public function calculateAllAnimalsSummedWeight(array $animals): int
    {
        $summedWeight = 0;

        foreach ($animals as $animal) {
            $summedWeight += $animal->getWeight();
        }

        return $summedWeight;
    }
}

class AmountOfFeedCalculator implements IAmountOfFeedCalculator
{
    private IAnimalInformationDisplay $animalInformationDisplay;


    public function __construct(IAnimalInformationDisplay $animalInformationDisplay)
    {
        $this->animalInformationDisplay = $animalInformationDisplay;
    }

    public function calculateAmountOfFeed(array $animals, int $numberOfDays): string
    {
        $summedWeight = 0;

        foreach ($animals as $animal) {
            if ($animal->getChip()->getSpecies() !== "cz??owiek") {
                $summedWeight += $animal->getWeight();
            }
        }

        return ($numberOfDays * $summedWeight)/30;
    }
}

class PolishAnimalInformationDisplay implements IAnimalInformationDisplay
{
    public function displayInformationForAnimal(IBaseAnimal $animal): string
    {
        $animalChip = $animal->getChip();
        $animalName = $animal->getChip()->getName();

        $text = "To jest $animalName. $animalName jest {$animalChip->getSpecies()}. $animalName 
            ma {$animalChip->getAge()} lat. $animalName, daj g??os! {$animal->getCall()} $animalName 
            ma numer identyfikacyjny {$animalChip->getIdNumber()}. $animalName przyby?? do ZOO 
            {$animalChip->getAdmissionDate()}. ";

        return $text;
    }

    public function displayAmountOfFeed(int $numberOfDays, float $amountOfFeed): string
    {
        $text = "Ilo???? karmy potrzebna dla wszystkich zwierz??t w Zoo na $numberOfDays dni to: $amountOfFeed kg.";

        return $text;
    }
}

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
            throw new Exception("Zwierz?? o ID " . $chip->getIdNumber() . " ju?? znajduje si?? w Zoo!");
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

        throw new Exception("Nie znaleziono zwierz??cia o ID " . $IdNumber);
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

        throw new Exception("Nie znaleziono zwierz??cia o ID " . $IdNumber);
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

$animalInformationDisplay = new EnglishAnimalInformationDisplay();
$summedWeightCalculator = new SummedWeightCalculator();
$amountOfFeedCalculator = new AmountOfFeedCalculator($animalInformationDisplay);
$zooService = new Zoo($animalInformationDisplay, $amountOfFeedCalculator, $summedWeightCalculator);


$cat1Chip = new Chip("NA-1234", "Nami", new DateTime("2015-07-23 15:00:00"), "kot");
$cat1 = new Cat(3);

$cat2Chip = new Chip("RA-1234", "Nami", new DateTime("2017-11-05 17:25:00"), "kot");
$cat2 = new Cat(3);

$dog1Chip = new Chip("DA-1234", "Dami", new DateTime("2020-01-17 23:57:00"), "pies");
$dog1 = new Dog(3);

$boar1Chip = new Chip("SA-1234", "Sami", new DateTime("2016-06-15 18:20:40"), "dzik");
$boar1 = new Boar(3);

$employee1Chip = new Chip("AN-1234", "Anna Nowak", new DateTime("1995-03-04 10:23:42"), "cz??owiek");
$employee1 = new Employee(52);


$zooService->addAnimal($cat1, $cat1Chip);
$zooService->addAnimal($cat2, $cat2Chip);
$zooService->addAnimal($dog1, $dog1Chip);
$zooService->addAnimal($boar1, $boar1Chip);
$zooService->addAnimal($employee1, $employee1Chip);
//$zooService->removeAnimal("RA-1234");
//var_dump($zooService->showAllAnimals());
//var_dump($zooService->showAllAnimalsBySpecies("kot"));
//var_dump($zooService->showAnimal($cat1Chip->getIdNumber()));
//var_dump($zooService->getAllAnimalsSummedWeight());
//var_dump($zooService->calculateAmountOfFeedForAnimals(12));

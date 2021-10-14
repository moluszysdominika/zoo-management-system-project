<?php

use Zoo\AmountOfFeedCalculator\AmountOfFeedCalculator;
use Zoo\Animal\Boar;
use Zoo\Animal\Cat;
use Zoo\Animal\Dog;
use Zoo\Animal\Employee;
use Zoo\AnimalInformationDisplay\PolishAnimalInformationDisplay;
use Zoo\Chip\Chip;
use Zoo\Service\Zoo;
use Zoo\SummedWeightCalculator\SummedWeightCalculator;

require_once 'vendor/autoload.php';

$animalInformationDisplay = new PolishAnimalInformationDisplay();
$summedWeightCalculator = new SummedWeightCalculator();
$amountOfFeedCalculator = new AmountOfFeedCalculator($summedWeightCalculator);
$zooService = new Zoo($animalInformationDisplay, $amountOfFeedCalculator, $summedWeightCalculator);

$cat1 = new Cat(3);
$cat1Chip = new Chip("NA-1234", "Nami", new DateTime("2015-07-23 15:00:00"));

$cat2 = new Cat(3);
$cat2Chip = new Chip("RA-1234", "Rami", new DateTime("2017-11-05 17:25:00"));

$dog1 = new Dog(3);
$dog1Chip = new Chip("DA-1234", "Dami", new DateTime("2020-01-17 23:57:00"));

$boar1 = new Boar(3);
$boar1Chip = new Chip("SA-1234", "Sami", new DateTime("2016-06-15 18:20:40"));

$employee1 = new Employee(52);
$employee1Chip = new Chip("AN-1234", "Anna Nowak", new DateTime("1995-03-04 10:23:42"));

$zooService->addAnimal($cat1, $cat1Chip);
$zooService->addAnimal($cat2, $cat2Chip);
$zooService->addAnimal($dog1, $dog1Chip);
$zooService->addAnimal($boar1, $boar1Chip);
$zooService->addAnimal($employee1, $employee1Chip);
//$zooService->removeAnimal($cat2Chip->getIdNumber());
//var_dump($zooService->showAllAnimals());
//var_dump($zooService->showAllAnimalsBySpecies(Dog::getSpecies()));
//var_dump($zooService->showAnimal($cat1Chip->getIdNumber()));
//var_dump($zooService->getAllAnimalsSummedWeight());
//var_dump($zooService->calculateAmountOfFeedForAnimals(12, Employee::getSpecies()));

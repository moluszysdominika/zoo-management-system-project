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

$cat1Chip = new Chip("NA-1234", "Nami", new DateTime("2015-07-23 15:00:00"), Cat::getSpecies());
$cat1 = new Cat(3);

$cat2Chip = new Chip("RA-1234", "Nami", new DateTime("2017-11-05 17:25:00"), Cat::getSpecies());
$cat2 = new Cat(3);

$dog1Chip = new Chip("DA-1234", "Dami", new DateTime("2020-01-17 23:57:00"), Dog::getSpecies());
$dog1 = new Dog(3);

$boar1Chip = new Chip("SA-1234", "Sami", new DateTime("2016-06-15 18:20:40"), Boar::getSpecies());
$boar1 = new Boar(3);

$employee1Chip = new Chip("AN-1234", "Anna Nowak", new DateTime("1995-03-04 10:23:42"), Employee::getSpecies());
$employee1 = new Employee(52);

$zooService->addAnimal($cat1, $cat1Chip);
$zooService->addAnimal($cat2, $cat2Chip);
$zooService->addAnimal($dog1, $dog1Chip);
$zooService->addAnimal($boar1, $boar1Chip);
$zooService->addAnimal($employee1, $employee1Chip);
//$zooService->removeAnimal("RA-1234");
//var_dump($zooService->showAllAnimals());
//var_dump($zooService->showAllAnimalsBySpecies(Cat::getSpecies()));
//var_dump($zooService->showAnimal($cat1Chip->getIdNumber()));
//var_dump($zooService->getAllAnimalsSummedWeight());
//var_dump($zooService->calculateAmountOfFeedForAnimals(12));

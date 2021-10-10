<?php

namespace Zoo\Animal;

class Dog extends BaseAnimal
{
    protected string $call = "Woof!";

    public static function getSpecies(): string
    {
        return "dog";
    }
}

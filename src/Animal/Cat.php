<?php

namespace Zoo\Animal;



class Cat extends BaseAnimal
{
    protected string $call = "Meow!";

    public static function getSpecies(): string
    {
        return "cat";
    }
}
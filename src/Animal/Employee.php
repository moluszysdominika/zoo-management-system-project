<?php

namespace Zoo\Animal;



class Employee extends BaseAnimal
{
    protected string $call = "Wreee!";

    public static function getSpecies(): string
    {
        return "human";
    }
}
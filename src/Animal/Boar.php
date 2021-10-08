<?php

namespace Zoo\Animal;



class Boar extends BaseAnimal
{
    protected string $call = "Oink!";

    public static function getSpecies(): string
    {
        return "boar";
    }
}
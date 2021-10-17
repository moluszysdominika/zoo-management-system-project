<?php

namespace Zoo\Animal;

interface IBaseAnimal
{
    public function getWeight(): float;

    public function getCall(): string;
}

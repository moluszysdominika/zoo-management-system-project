<?php

namespace Zoo\Animal;

abstract class BaseAnimal implements IBaseAnimal
{
    private float $weight;
    protected string $call;

    public function __construct(float $weight)
    {
        $this->weight = $weight;
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

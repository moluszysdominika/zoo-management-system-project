<?php

namespace Zoo\Chip;

use DateTime;

class Chip
{
    private string $IdNumber;
    private string $name;
    private DateTime $birthDate;
    private ?string $species = null;
    private DateTime $admissionDate;

    public function __construct(string $IdNumber, string $name, DateTime $birthDate)
    {
        $this->IdNumber = $IdNumber;
        $this->name = $name;
        $this->birthDate = $birthDate;
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

    public function setSpecies(string $species): void
    {
        $this->species = $species;
    }

    public function getAdmissionDate(): string
    {
        return $this->admissionDate->format("d/m/Y H:i:s");
    }
}

<?php

class Car implements VehicleInterface
{
    public $licensePlates;
    public $typeID;
    public $type;
    public $occupationSpots;

    public function __construct($licensePlates)
    {
        $this->licensePlates = $licensePlates;
        $this->typeID = 2;
        $this->type = "Car";
        $this->occupationSpots = 1;
    }

    public function getLicensePlates(): string
    {
        return $this->licensePlates;
    }

    public function getTypeID(): string
    {
        return $this->typeID;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getOccupationSpots(): int
    {
        return $this->occupationSpots;
    }
}

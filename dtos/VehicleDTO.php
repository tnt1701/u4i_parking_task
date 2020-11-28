<?php

class VehicleDTO
{
    public $licensePlates;
    public $typeID;
    public $type;
    public $occupiedSpots;

    public function __construct($licensePlates, $typeID, $type, $occupiedSpots)
    {
        $this->licensePlates = $licensePlates;
        $this->typeID = $typeID;
        $this->type = $type;
        $this->occupiedSpots = $occupiedSpots;
    }
}

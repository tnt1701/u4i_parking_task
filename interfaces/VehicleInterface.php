<?php

interface VehicleInterface
{
    function getLicensePlates(): string;
    function getTypeID(): string;
    function getType(): string;
    function getOccupationSpots(): int;
}

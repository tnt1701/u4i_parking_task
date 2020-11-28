<?php

interface ParkingLotServiceInterface
{
    function parkVehicle(VehicleInterface $vehicle);
    function unparkVehicle($licensePlates);
}

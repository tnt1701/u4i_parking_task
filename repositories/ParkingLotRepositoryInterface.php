<?php

interface ParkingLotRepositoryInterface
{
    function all();
    function getTotalOccupiedSpots();
    function findByLicensePlates($licensePlates);
    function parkVehicle(VehicleDTO $vehicle);
    function unparkVehicle($licensePlates);
}

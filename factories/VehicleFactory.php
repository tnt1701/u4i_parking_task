<?php

class VehicleFactory
{
    const BUS = 1;
    const CAR = 2;
    const BIKE = 3;

    public static function getVehicle(int $type, string $licensePlates): ?VehicleInterface
    {
        if ($licensePlates === null || $type === null) {
            return null;
        }

        switch ($type) {
            case self::BUS:
                return new Bus($licensePlates);
            case self::CAR:
                return new Car($licensePlates);
            case self::BIKE:
                return new Bike($licensePlates);
            default:
                return null;
        }
    }
}

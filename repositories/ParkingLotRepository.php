<?php

class ParkingLotRepository implements ParkingLotRepositoryInterface
{
    public function all()
    {
        $results = App::get('database')->all('parking_lot');

        $vehicles = [];

        foreach ($results as $result) {
            $vehicle = new VehicleDTO(
                $result->license_plates,
                $result->vehicle_type_id,
                $result->vehicle_type,
                $result->occupied_spots
            );
            array_push($vehicles, $vehicle);
        }

        return $vehicles;
    }

    public function getTotalOccupiedSpots()
    {
        return App::get('database')->getSumBy(
            'parking_lot',
            'occupied_spots'
        );
    }

    public function findByLicensePlates($licensePlates)
    {
        return App::get('database')->findBy(
            'parking_lot',
            'license_plates',
            'licensePlates',
            $licensePlates
        );
    }

    public function parkVehicle(VehicleDTO $vehicle)
    {
        App::get('database')->create('parking_lot', [
            'license_plates' => $vehicle->licensePlates,
            'vehicle_type_id' => $vehicle->typeID,
            'vehicle_type' => $vehicle->type,
            'occupied_spots' => $vehicle->occupiedSpots
        ]);
    }

    public function unparkVehicle($licensePlates)
    {
        App::get('database')->delete(
            'parking_lot',
            'license_plates',
            'licensePlates',
            $licensePlates
        );
    }
}

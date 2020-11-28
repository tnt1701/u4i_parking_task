<?php

class ParkingLotService implements ParkingLotServiceInterface
{
      protected $parkingLotRepository;

      protected $maxSpots = 100;

      public function __construct()
      {
          $this->parkingLotRepository = new ParkingLotRepository();
      }

      public function getListOfVehicles()
      {
          return $this->parkingLotRepository->all();
      }

      public function parkVehicle(VehicleInterface $vehicle)
      {
          $occupiedSpots = $this->parkingLotRepository->getTotalOccupiedSpots();

          $vehiclePlates = $vehicle->getLicensePlates();
          $vehicleTypeID = $vehicle->getTypeID();
          $vehicleType = $vehicle->getType();
          $vehicleOccupationSpots = $vehicle->getOccupationSpots();

          if ($vehiclePlates === null || strlen($vehiclePlates) === 0) {
              throw new Exception('There is no car to be parked on the parking lot.');
          }

          if (($this->maxSpots - $occupiedSpots) < $vehicleOccupationSpots) {
              throw new Exception('All the places are currenty occupied.');
          }

          if ($this->isParked($vehiclePlates)) {
              throw new Exception('The parking lot is already occupied by the vehicle with this license plates');
          }

          $vehicleDTO = new VehicleDTO(
              $vehiclePlates,
              $vehicleTypeID,
              $vehicleType,
              $vehicleOccupationSpots
          );

          $this->parkingLotRepository->parkVehicle($vehicleDTO);

          return $vehicleDTO;
      }

      private function isParked($licensePlates)
      {
          return $this->parkingLotRepository->findByLicensePlates($licensePlates);
      }

      public function unparkVehicle($licensePlates)
      {
          $vehicle = $this->parkingLotRepository->findByLicensePlates($licensePlates);

          if (!$vehicle) {
              throw new Exception('There is no car on parking lot with requested license plates.');
          }

          $this->parkingLotRepository->unparkVehicle($licensePlates);
      }
}

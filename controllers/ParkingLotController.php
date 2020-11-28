<?php

class ParkingLotController
{
    protected $parkingLotService;

    public function __construct()
    {
        $this->parkingLotService = new ParkingLotService;
    }

    public function home()
    {
        $vehicles = $this->parkingLotService->getListOfVehicles();

        echo json_encode(new Response($vehicles));
    }

    public function parkVehicle()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $licensePlates = $data['license_plates'];
        $vehicleTypeID = $data['typeID'];

        $vehicle = VehicleFactory::getVehicle($vehicleTypeID, $licensePlates);

        if ($vehicle === null) {
            echo json_encode(new MessageResponse('Parking lot is not supporting vehicle of this type.'));

            return;
        }

        try {
            $vehicle = $this->parkingLotService->parkVehicle($vehicle);
            echo json_encode(new Response($vehicle));
        } catch (Exception $e) {
            echo json_encode(new MessageResponse($e->getMessage()));
        }
    }

    public function unparkVehicle()
    {
        $data = json_decode(file_get_contents('php://input'), true);

        $licensePlates = $data['license_plates'];

        try {
            $this->parkingLotService->unparkVehicle($licensePlates);
            echo json_encode(new MessageResponse('Data has been deleted.'));
        } catch (Exception $e) {
            echo json_encode(new MessageResponse($e->getMessage()));
        }
    }
}

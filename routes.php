<?php

$router->get('', 'ParkingLotController@home');
$router->post('park', 'ParkingLotController@parkVehicle');
$router->delete('unpark', 'ParkingLotController@unparkVehicle');

<?php

return [
    'database' => [
        'name' => 'parking_lot_db',
        'username' => 'homestead',
        'password' => 'secret',
        'connection' => 'mysql:host=127.0.0.1',
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
      ]
    ],
    'parking_lot' => [
        'max_occupied_spots' => 120
      ]
];

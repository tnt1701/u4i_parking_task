<?php

App::bind('config', require 'config.php');

App::bind('database', new QueryBuilder(
    Connection::make(App::get('config')['database'])
));

App::bind('max_occupied_spots', App::get('config')['parking_lot']['max_occupied_spots']);

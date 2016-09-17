<?php

return [

    //******************************************************************************************************************
    //***   Type of place that you can do a reservation
    //******************************************************************************************************************
    'models'                    => [
        (object)['id' => 1,    'name' => 'hotels::pulsar.hotel',        'model' => Syscover\Hotels\Models\Hotel::class],
        (object)['id' => 2,    'name' => 'wineries::pulsar.winery',     'model' => Syscover\Wineries\Models\Winery::class],
        (object)['id' => 3,    'name' => 'spas::pulsar.spa',            'model' => Syscover\Spas\Models\Spa::class],
    ],

    //******************************************************************************************************************
    //***   Status of booking
    //******************************************************************************************************************
    'status'                    => [
        (object)['id' => 1,    'name' => 'pulsar::pulsar.cancel'],
        (object)['id' => 2,    'name' => 'pulsar::pulsar.confirmed'],
    ],

    //******************************************************************************************************************
    //***   Breakfast
    //******************************************************************************************************************
    'breakfast'                    => [
        (object)['id' => 1,    'name' => 'pulsar::pulsar.included'],
        (object)['id' => 2,    'name' => 'pulsar::pulsar.not_included'],
    ],
];
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
        (object)['id' => 1,    'name' => 'booking::pulsar.cancel'],
        (object)['id' => 2,    'name' => 'booking::pulsar.confirmed'],
    ],
];
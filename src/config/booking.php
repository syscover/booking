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
        (object)['id' => 2,    'name' => 'pulsar::pulsar.confirmed']
    ],

    //******************************************************************************************************************
    //***   Breakfast
    //******************************************************************************************************************
    'breakfast'                    => [
        (object)['id' => 1,    'name' => 'pulsar::pulsar.included'],
        (object)['id' => 2,    'name' => 'pulsar::pulsar.not_included'],
    ],

    //******************************************************************************************************************
    //***   Commissions
    //******************************************************************************************************************
    'commissions'                    => [
        (object)['id' => 0,     'name' => '0%'],
        (object)['id' => 5,     'name' => '5%'],
        (object)['id' => 7,     'name' => '7%'],
        (object)['id' => 10,    'name' => '10%'],
        (object)['id' => 15,    'name' => '15%'],
    ],

    //******************************************************************************************************************
    //***   Taxes
    //******************************************************************************************************************
    'taxes'                    => [
        (object)['id' => 0,     'name' => '0%'],
        (object)['id' => 5,     'name' => '4%'],
        (object)['id' => 7,     'name' => '10%'],
        (object)['id' => 10,    'name' => '21%']
    ],
];
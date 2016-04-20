<?php

Route::group(['middleware' => ['web', 'pulsar']], function() {

    /*
    |--------------------------------------------------------------------------
    | VOUCHERS
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.appName') . '/booking/voucher/{offset?}',                          ['as'=>'bookingVoucher',                   'uses'=>'Syscover\Booking\Controllers\VoucherController@index',                      'resource' => 'booking-voucher',       'action' => 'access']);
    Route::any(config('pulsar.appName') . '/booking/voucher/json/data',                          ['as'=>'jsonDataBookingVoucher',           'uses'=>'Syscover\Booking\Controllers\VoucherController@jsonData',                   'resource' => 'booking-voucher',       'action' => 'access']);
    Route::get(config('pulsar.appName') . '/booking/voucher/create/{offset}',                    ['as'=>'createBookingVoucher',             'uses'=>'Syscover\Booking\Controllers\VoucherController@createRecord',               'resource' => 'booking-voucher',       'action' => 'create']);
    Route::post(config('pulsar.appName') . '/booking/voucher/store/{offset}',                    ['as'=>'storeBookingVoucher',              'uses'=>'Syscover\Booking\Controllers\VoucherController@storeRecord',                'resource' => 'booking-voucher',       'action' => 'create']);
    Route::get(config('pulsar.appName') . '/booking/voucher/{id}/edit/{offset}',                 ['as'=>'editBookingVoucher',               'uses'=>'Syscover\Booking\Controllers\VoucherController@editRecord',                 'resource' => 'booking-voucher',       'action' => 'access']);
    Route::put(config('pulsar.appName') . '/booking/voucher/update/{id}/{offset}',               ['as'=>'updateBookingVoucher',             'uses'=>'Syscover\Booking\Controllers\VoucherController@updateRecord',               'resource' => 'booking-voucher',       'action' => 'edit']);
    Route::get(config('pulsar.appName') . '/booking/voucher/delete/{id}/{offset}',               ['as'=>'deleteBookingVoucher',             'uses'=>'Syscover\Booking\Controllers\VoucherController@deleteRecord',               'resource' => 'booking-voucher',       'action' => 'delete']);
    Route::delete(config('pulsar.appName') . '/booking/voucher/delete/select/records',           ['as'=>'deleteSelectBookingVoucher',       'uses'=>'Syscover\Booking\Controllers\VoucherController@deleteRecordsSelect',        'resource' => 'booking-voucher',       'action' => 'delete']);


    Route::any(config('pulsar.appName') . '/booking/customer/modal/{offset}/{modal}',            ['as'=>'modalBookingCustomer',             'uses'=>'Syscover\Crm\Controllers\CustomerController@index',                         'resource' => 'booking-voucher',       'action' => 'access']);
});
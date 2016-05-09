<?php

Route::group(['middleware' => ['web', 'pulsar']], function() {

    /*
    |--------------------------------------------------------------------------
    | VOUCHERS
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.appName') . '/booking/vouchers/{offset?}',                          ['as'=>'bookingVoucher',                   'uses'=>'Syscover\Booking\Controllers\VoucherController@index',                      'resource' => 'booking-voucher',       'action' => 'access']);
    Route::any(config('pulsar.appName') . '/booking/vouchers/json/data',                          ['as'=>'jsonDataBookingVoucher',           'uses'=>'Syscover\Booking\Controllers\VoucherController@jsonData',                   'resource' => 'booking-voucher',       'action' => 'access']);
    Route::get(config('pulsar.appName') . '/booking/vouchers/create/{offset}/{bulk?}',            ['as'=>'createBookingVoucher',             'uses'=>'Syscover\Booking\Controllers\VoucherController@createRecord',               'resource' => 'booking-voucher',       'action' => 'create']);
    Route::post(config('pulsar.appName') . '/booking/vouchers/store/{offset}',                    ['as'=>'storeBookingVoucher',              'uses'=>'Syscover\Booking\Controllers\VoucherController@storeRecord',                'resource' => 'booking-voucher',       'action' => 'create']);
    Route::get(config('pulsar.appName') . '/booking/vouchers/{id}/edit/{offset}',                 ['as'=>'editBookingVoucher',               'uses'=>'Syscover\Booking\Controllers\VoucherController@editRecord',                 'resource' => 'booking-voucher',       'action' => 'access']);
    Route::put(config('pulsar.appName') . '/booking/vouchers/update/{id}/{offset}',               ['as'=>'updateBookingVoucher',             'uses'=>'Syscover\Booking\Controllers\VoucherController@updateRecord',               'resource' => 'booking-voucher',       'action' => 'edit']);
    Route::get(config('pulsar.appName') . '/booking/vouchers/delete/{id}/{offset}',               ['as'=>'deleteBookingVoucher',             'uses'=>'Syscover\Booking\Controllers\VoucherController@deleteRecord',               'resource' => 'booking-voucher',       'action' => 'delete']);
    Route::delete(config('pulsar.appName') . '/booking/vouchers/delete/select/records',           ['as'=>'deleteSelectBookingVoucher',       'uses'=>'Syscover\Booking\Controllers\VoucherController@deleteRecordsSelect',        'resource' => 'booking-voucher',       'action' => 'delete']);


    Route::any(config('pulsar.appName') . '/booking/customer/modal/{offset}/{modal}',            ['as'=>'modalBookingCustomer',             'uses'=>'Syscover\Crm\Controllers\CustomerController@index',                         'resource' => 'booking-voucher',       'action' => 'access']);


    /*
    |--------------------------------------------------------------------------
    | CAMPAIGNS
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.appName') . '/booking/campaigns/{offset?}',                          ['as'=>'bookingCampaign',                   'uses'=>'Syscover\Booking\Controllers\CampaignController@index',                      'resource' => 'booking-campaign',       'action' => 'access']);
    Route::any(config('pulsar.appName') . '/booking/campaigns/json/data',                          ['as'=>'jsonDataBookingCampaign',           'uses'=>'Syscover\Booking\Controllers\CampaignController@jsonData',                   'resource' => 'booking-campaign',       'action' => 'access']);
    Route::get(config('pulsar.appName') . '/booking/campaigns/create/{offset}',                    ['as'=>'createBookingCampaign',             'uses'=>'Syscover\Booking\Controllers\CampaignController@createRecord',               'resource' => 'booking-campaign',       'action' => 'create']);
    Route::post(config('pulsar.appName') . '/booking/campaigns/store/{offset}',                    ['as'=>'storeBookingCampaign',              'uses'=>'Syscover\Booking\Controllers\CampaignController@storeRecord',                'resource' => 'booking-campaign',       'action' => 'create']);
    Route::get(config('pulsar.appName') . '/booking/campaigns/{id}/edit/{offset}',                 ['as'=>'editBookingCampaign',               'uses'=>'Syscover\Booking\Controllers\CampaignController@editRecord',                 'resource' => 'booking-campaign',       'action' => 'access']);
    Route::put(config('pulsar.appName') . '/booking/campaigns/update/{id}/{offset}',               ['as'=>'updateBookingCampaign',             'uses'=>'Syscover\Booking\Controllers\CampaignController@updateRecord',               'resource' => 'booking-campaign',       'action' => 'edit']);
    Route::get(config('pulsar.appName') . '/booking/campaigns/delete/{id}/{offset}',               ['as'=>'deleteBookingCampaign',             'uses'=>'Syscover\Booking\Controllers\CampaignController@deleteRecord',               'resource' => 'booking-campaign',       'action' => 'delete']);
    Route::delete(config('pulsar.appName') . '/booking/campaigns/delete/select/records',           ['as'=>'deleteSelectBookingCampaign',       'uses'=>'Syscover\Booking\Controllers\CampaignController@deleteRecordsSelect',        'resource' => 'booking-campaign',       'action' => 'delete']);

    /*
    |--------------------------------------------------------------------------
    | PLACES
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.appName') . '/booking/places/{offset?}',                          ['as'=>'bookingPlace',                   'uses'=>'Syscover\Booking\Controllers\PlaceController@index',                      'resource' => 'booking-place',       'action' => 'access']);
    Route::any(config('pulsar.appName') . '/booking/places/json/data',                          ['as'=>'jsonDataBookingPlace',           'uses'=>'Syscover\Booking\Controllers\PlaceController@jsonData',                   'resource' => 'booking-place',       'action' => 'access']);
    Route::get(config('pulsar.appName') . '/booking/places/create/{offset}',                    ['as'=>'createBookingPlace',             'uses'=>'Syscover\Booking\Controllers\PlaceController@createRecord',               'resource' => 'booking-place',       'action' => 'create']);
    Route::post(config('pulsar.appName') . '/booking/places/store/{offset}',                    ['as'=>'storeBookingPlace',              'uses'=>'Syscover\Booking\Controllers\PlaceController@storeRecord',                'resource' => 'booking-place',       'action' => 'create']);
    Route::get(config('pulsar.appName') . '/booking/places/{id}/edit/{offset}',                 ['as'=>'editBookingPlace',               'uses'=>'Syscover\Booking\Controllers\PlaceController@editRecord',                 'resource' => 'booking-place',       'action' => 'access']);
    Route::put(config('pulsar.appName') . '/booking/places/update/{id}/{offset}',               ['as'=>'updateBookingPlace',             'uses'=>'Syscover\Booking\Controllers\PlaceController@updateRecord',               'resource' => 'booking-place',       'action' => 'edit']);
    Route::get(config('pulsar.appName') . '/booking/places/delete/{id}/{offset}',               ['as'=>'deleteBookingPlace',             'uses'=>'Syscover\Booking\Controllers\PlaceController@deleteRecord',               'resource' => 'booking-place',       'action' => 'delete']);
    Route::delete(config('pulsar.appName') . '/booking/places/delete/select/records',           ['as'=>'deleteSelectBookingPlace',       'uses'=>'Syscover\Booking\Controllers\PlaceController@deleteRecordsSelect',        'resource' => 'booking-place',       'action' => 'delete']);
});
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
    | PRODUCT PREFIX
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.appName') . '/booking/family/{offset?}',                          ['as'=>'bookingFamily',                   'uses'=>'Syscover\Booking\Controllers\FamilyController@index',                      'resource' => 'booking-family',       'action' => 'access']);
    Route::any(config('pulsar.appName') . '/booking/family/json/data',                          ['as'=>'jsonDataBookingFamily',           'uses'=>'Syscover\Booking\Controllers\FamilyController@jsonData',                   'resource' => 'booking-family',       'action' => 'access']);
    Route::get(config('pulsar.appName') . '/booking/family/create/{offset}',                    ['as'=>'createBookingFamily',             'uses'=>'Syscover\Booking\Controllers\FamilyController@createRecord',               'resource' => 'booking-family',       'action' => 'create']);
    Route::post(config('pulsar.appName') . '/booking/family/store/{offset}',                    ['as'=>'storeBookingFamily',              'uses'=>'Syscover\Booking\Controllers\FamilyController@storeRecord',                'resource' => 'booking-family',       'action' => 'create']);
    Route::get(config('pulsar.appName') . '/booking/family/{id}/edit/{offset}',                 ['as'=>'editBookingFamily',               'uses'=>'Syscover\Booking\Controllers\FamilyController@editRecord',                 'resource' => 'booking-family',       'action' => 'access']);
    Route::put(config('pulsar.appName') . '/booking/family/update/{id}/{offset}',               ['as'=>'updateBookingFamily',             'uses'=>'Syscover\Booking\Controllers\FamilyController@updateRecord',               'resource' => 'booking-family',       'action' => 'edit']);
    Route::get(config('pulsar.appName') . '/booking/family/delete/{id}/{offset}',               ['as'=>'deleteBookingFamily',             'uses'=>'Syscover\Booking\Controllers\FamilyController@deleteRecord',               'resource' => 'booking-family',       'action' => 'delete']);
    Route::delete(config('pulsar.appName') . '/booking/family/delete/select/records',           ['as'=>'deleteSelectBookingFamily',       'uses'=>'Syscover\Booking\Controllers\FamilyController@deleteRecordsSelect',        'resource' => 'booking-family',       'action' => 'delete']);


    /*
    |--------------------------------------------------------------------------
    | PRODUCT PREFIX
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.appName') . '/booking/products/prefix/{offset?}',                          ['as'=>'bookingProductPrefix',                   'uses'=>'Syscover\Booking\Controllers\ProductPrefixController@index',                      'resource' => 'booking-product-prefix',       'action' => 'access']);
    Route::any(config('pulsar.appName') . '/booking/products/prefix/json/data',                          ['as'=>'jsonDataBookingProductPrefix',           'uses'=>'Syscover\Booking\Controllers\ProductPrefixController@jsonData',                   'resource' => 'booking-product-prefix',       'action' => 'access']);
    Route::get(config('pulsar.appName') . '/booking/products/prefix/create/{offset}',                    ['as'=>'createBookingProductPrefix',             'uses'=>'Syscover\Booking\Controllers\ProductPrefixController@createRecord',               'resource' => 'booking-product-prefix',       'action' => 'create']);
    Route::post(config('pulsar.appName') . '/booking/products/prefix/store/{offset}',                    ['as'=>'storeBookingProductPrefix',              'uses'=>'Syscover\Booking\Controllers\ProductPrefixController@storeRecord',                'resource' => 'booking-product-prefix',       'action' => 'create']);
    Route::get(config('pulsar.appName') . '/booking/products/prefix/{id}/edit/{offset}',                 ['as'=>'editBookingProductPrefix',               'uses'=>'Syscover\Booking\Controllers\ProductPrefixController@editRecord',                 'resource' => 'booking-product-prefix',       'action' => 'access']);
    Route::put(config('pulsar.appName') . '/booking/products/prefix/update/{id}/{offset}',               ['as'=>'updateBookingProductPrefix',             'uses'=>'Syscover\Booking\Controllers\ProductPrefixController@updateRecord',               'resource' => 'booking-product-prefix',       'action' => 'edit']);
    Route::get(config('pulsar.appName') . '/booking/products/prefix/delete/{id}/{offset}',               ['as'=>'deleteBookingProductPrefix',             'uses'=>'Syscover\Booking\Controllers\ProductPrefixController@deleteRecord',               'resource' => 'booking-product-prefix',       'action' => 'delete']);
    Route::delete(config('pulsar.appName') . '/booking/products/prefix/delete/select/records',           ['as'=>'deleteSelectBookingProductPrefix',       'uses'=>'Syscover\Booking\Controllers\ProductPrefixController@deleteRecordsSelect',        'resource' => 'booking-product-prefix',       'action' => 'delete']);


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
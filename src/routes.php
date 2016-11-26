<?php

Route::group(['middleware' => ['web', 'pulsar']], function() {

    /*
    |--------------------------------------------------------------------------
    | BOOKINGS
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.name') . '/booking/bookings/{offset?}',                                   ['as' => 'bookingBooking',                      'uses' => 'Syscover\Booking\Controllers\BookingController@index',                      'resource' => 'booking-booking',       'action' => 'access']);
    Route::any(config('pulsar.name') . '/booking/bookings/json/data',                                   ['as' => 'jsonDataBookingBooking',              'uses' => 'Syscover\Booking\Controllers\BookingController@jsonData',                   'resource' => 'booking-booking',       'action' => 'access']);
    Route::get(config('pulsar.name') . '/booking/bookings/create/{offset}',                             ['as' => 'createBookingBooking',                'uses' => 'Syscover\Booking\Controllers\BookingController@createRecord',               'resource' => 'booking-booking',       'action' => 'create']);
    Route::post(config('pulsar.name') . '/booking/bookings/store/{offset}',                             ['as' => 'storeBookingBooking',                 'uses' => 'Syscover\Booking\Controllers\BookingController@storeRecord',                'resource' => 'booking-booking',       'action' => 'create']);
    Route::get(config('pulsar.name') . '/booking/bookings/{id}/edit/{offset}',                          ['as' => 'editBookingBooking',                  'uses' => 'Syscover\Booking\Controllers\BookingController@editRecord',                 'resource' => 'booking-booking',       'action' => 'access']);
    Route::put(config('pulsar.name') . '/booking/bookings/update/{id}/{offset}',                        ['as' => 'updateBookingBooking',                'uses' => 'Syscover\Booking\Controllers\BookingController@updateRecord',               'resource' => 'booking-booking',       'action' => 'edit']);
    Route::get(config('pulsar.name') . '/booking/bookings/delete/{id}/{offset}',                        ['as' => 'deleteBookingBooking',                'uses' => 'Syscover\Booking\Controllers\BookingController@deleteRecord',               'resource' => 'booking-booking',       'action' => 'delete']);
    Route::delete(config('pulsar.name') . '/booking/bookings/delete/select/records',                    ['as' => 'deleteSelectBookingBooking',          'uses' => 'Syscover\Booking\Controllers\BookingController@deleteRecordsSelect',        'resource' => 'booking-booking',       'action' => 'delete']);
    Route::get(config('pulsar.name') . '/booking/bookings/{id}/show/{offset}',                          ['as' => 'showBookingBooking',                  'uses' => 'Syscover\Booking\Controllers\BookingController@showRecord',                 'resource' => 'booking-booking',       'action' => 'access']);
    Route::post(config('pulsar.name') . '/booking/bookings/{id}/show/{offset}/{resendEmails}',          ['as' => 'showBookingBookingResendEmails',      'uses' => 'Syscover\Booking\Controllers\BookingController@showRecord',                 'resource' => 'booking-booking',       'action' => 'access']);

    /*
    |--------------------------------------------------------------------------
    | BOOKINGS DRAFT
    |--------------------------------------------------------------------------
    */
//    Route::any(config('pulsar.name') . '/booking/bookings/draft/{offset?}',                             ['as' => 'bookingBookingDraft',                   'uses' => 'Syscover\Booking\Controllers\BookingDraftController@index',                      'resource' => 'booking-booking-draft',       'action' => 'access']);
//    Route::any(config('pulsar.name') . '/booking/bookings/draft/json/data',                             ['as' => 'jsonDataBookingBookingDraft',           'uses' => 'Syscover\Booking\Controllers\BookingDraftController@jsonData',                   'resource' => 'booking-booking-draft',       'action' => 'access']);
//    Route::get(config('pulsar.name') . '/booking/bookings/draft/create/{offset}',                       ['as' => 'createBookingBookingDraft',             'uses' => 'Syscover\Booking\Controllers\BookingDraftController@createRecord',               'resource' => 'booking-booking-draft',       'action' => 'create']);
//    Route::post(config('pulsar.name') . '/booking/bookings/draft/store/{offset}',                       ['as' => 'storeBookingBookingDraft',              'uses' => 'Syscover\Booking\Controllers\BookingDraftController@storeRecord',                'resource' => 'booking-booking-draft',       'action' => 'create']);
//    Route::get(config('pulsar.name') . '/booking/bookings/draft/{id}/edit/{offset}',                    ['as' => 'editBookingBookingDraft',               'uses' => 'Syscover\Booking\Controllers\BookingDraftController@editRecord',                 'resource' => 'booking-booking-draft',       'action' => 'access']);
//    Route::put(config('pulsar.name') . '/booking/bookings/draft/update/{id}/{offset}',                  ['as' => 'updateBookingBookingDraft',             'uses' => 'Syscover\Booking\Controllers\BookingDraftController@updateRecord',               'resource' => 'booking-booking-draft',       'action' => 'edit']);
//    Route::get(config('pulsar.name') . '/booking/bookings/draft/delete/{id}/{offset}',                  ['as' => 'deleteBookingBookingDraft',             'uses' => 'Syscover\Booking\Controllers\BookingDraftController@deleteRecord',               'resource' => 'booking-booking-draft',       'action' => 'delete']);
//    Route::delete(config('pulsar.name') . '/booking/bookings/draft/delete/select/records',              ['as' => 'deleteSelectBookingBookingDraft',       'uses' => 'Syscover\Booking\Controllers\BookingDraftController@deleteRecordsSelect',        'resource' => 'booking-booking-draft',       'action' => 'delete']);

    /*
    |--------------------------------------------------------------------------
    | VOUCHERS
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.name') . '/booking/vouchers/{modal}/{offset?}',                           ['as' => 'bookingVoucher',                              'uses' => 'Syscover\Booking\Controllers\VoucherController@index',                        'resource' => 'booking-voucher',       'action' => 'access']);
    Route::any(config('pulsar.name') . '/booking/vouchers/json/data/{modal}',                           ['as' => 'jsonDataBookingVoucher',                      'uses' => 'Syscover\Booking\Controllers\VoucherController@jsonData',                     'resource' => 'booking-voucher',       'action' => 'access']);
    Route::get(config('pulsar.name') . '/booking/vouchers/create/{offset}/{modal}/{bulk?}',             ['as' => 'createBookingVoucher',                        'uses' => 'Syscover\Booking\Controllers\VoucherController@createRecord',                 'resource' => 'booking-voucher',       'action' => 'create']);
    Route::post(config('pulsar.name') . '/booking/vouchers/store/{offset}/{modal}/{bulk?}',             ['as' => 'storeBookingVoucher',                         'uses' => 'Syscover\Booking\Controllers\VoucherController@storeRecord',                  'resource' => 'booking-voucher',       'action' => 'create']);
    Route::get(config('pulsar.name') . '/booking/vouchers/{id}/edit/{offset}/{modal}',                  ['as' => 'editBookingVoucher',                          'uses' => 'Syscover\Booking\Controllers\VoucherController@editRecord',                   'resource' => 'booking-voucher',       'action' => 'access']);
    Route::put(config('pulsar.name') . '/booking/vouchers/update/{id}/{offset}/{modal}',                ['as' => 'updateBookingVoucher',                        'uses' => 'Syscover\Booking\Controllers\VoucherController@updateRecord',                 'resource' => 'booking-voucher',       'action' => 'edit']);
    Route::get(config('pulsar.name') . '/booking/vouchers/delete/{id}/{offset}/{modal}',                ['as' => 'deleteBookingVoucher',                        'uses' => 'Syscover\Booking\Controllers\VoucherController@deleteRecord',                 'resource' => 'booking-voucher',       'action' => 'delete']);
    Route::delete(config('pulsar.name') . '/booking/vouchers/delete/select/records/{modal}',            ['as' => 'deleteSelectBookingVoucher',                  'uses' => 'Syscover\Booking\Controllers\VoucherController@deleteRecordsSelect',          'resource' => 'booking-voucher',       'action' => 'delete']);

    Route::post(config('pulsar.name') . '/booking/vouchers/get/data/objects/{model}',                   ['as' => 'bookingGetDataObjects',                       'uses' => 'Syscover\Booking\Controllers\VoucherController@getDataObjects',               'resource' => 'booking-voucher',       'action' => 'access']);
    Route::any(config('pulsar.name') . '/booking/vouchers/export/data',                                 ['as' => 'exportCsvBookingVoucher',                     'uses' => 'Syscover\Booking\Controllers\VoucherController@exportData',                   'resource' => 'booking-voucher',       'action' => 'access']);
    Route::post(config('pulsar.name') . '/booking/vouchers/advanced/search/data/count',                 ['as' => 'bookingVoucherAdvancedSearchDataCount',       'uses' => 'Syscover\Booking\Controllers\VoucherController@countAdvancedSearchData',      'resource' => 'booking-voucher',       'action' => 'access']);

    //Route::any(config('pulsar.name') . '/booking/customer/modal/{offset}/{modal}',                    ['as' => 'modalBookingCustomer',                        'uses' => 'Syscover\Crm\Controllers\CustomerController@index',                         'resource' => 'booking-voucher',       'action' => 'access']);
    Route::any(config('pulsar.name') . '/booking/vouchers/available/{available}/{modal}/{offset?}',     ['as' => 'bookingVoucherAvailable',                     'uses' => 'Syscover\Booking\Controllers\VoucherController@index',                       'resource' => 'booking-voucher',       'action' => 'access']);


    /*
    |--------------------------------------------------------------------------
    | PRODUCT PREFIX
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.name') . '/booking/family/{offset?}',                          ['as' => 'bookingFamily',                   'uses' => 'Syscover\Booking\Controllers\FamilyController@index',                      'resource' => 'booking-family',       'action' => 'access']);
    Route::any(config('pulsar.name') . '/booking/family/json/data',                          ['as' => 'jsonDataBookingFamily',           'uses' => 'Syscover\Booking\Controllers\FamilyController@jsonData',                   'resource' => 'booking-family',       'action' => 'access']);
    Route::get(config('pulsar.name') . '/booking/family/create/{offset}',                    ['as' => 'createBookingFamily',             'uses' => 'Syscover\Booking\Controllers\FamilyController@createRecord',               'resource' => 'booking-family',       'action' => 'create']);
    Route::post(config('pulsar.name') . '/booking/family/store/{offset}',                    ['as' => 'storeBookingFamily',              'uses' => 'Syscover\Booking\Controllers\FamilyController@storeRecord',                'resource' => 'booking-family',       'action' => 'create']);
    Route::get(config('pulsar.name') . '/booking/family/{id}/edit/{offset}',                 ['as' => 'editBookingFamily',               'uses' => 'Syscover\Booking\Controllers\FamilyController@editRecord',                 'resource' => 'booking-family',       'action' => 'access']);
    Route::put(config('pulsar.name') . '/booking/family/update/{id}/{offset}',               ['as' => 'updateBookingFamily',             'uses' => 'Syscover\Booking\Controllers\FamilyController@updateRecord',               'resource' => 'booking-family',       'action' => 'edit']);
    Route::get(config('pulsar.name') . '/booking/family/delete/{id}/{offset}',               ['as' => 'deleteBookingFamily',             'uses' => 'Syscover\Booking\Controllers\FamilyController@deleteRecord',               'resource' => 'booking-family',       'action' => 'delete']);
    Route::delete(config('pulsar.name') . '/booking/family/delete/select/records',           ['as' => 'deleteSelectBookingFamily',       'uses' => 'Syscover\Booking\Controllers\FamilyController@deleteRecordsSelect',        'resource' => 'booking-family',       'action' => 'delete']);


    /*
    |--------------------------------------------------------------------------
    | PRODUCT PREFIX
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.name') . '/booking/products/prefix/{offset?}',                          ['as' => 'bookingProductPrefix',                   'uses' => 'Syscover\Booking\Controllers\ProductPrefixController@index',                      'resource' => 'booking-product-prefix',       'action' => 'access']);
    Route::any(config('pulsar.name') . '/booking/products/prefix/json/data',                          ['as' => 'jsonDataBookingProductPrefix',           'uses' => 'Syscover\Booking\Controllers\ProductPrefixController@jsonData',                   'resource' => 'booking-product-prefix',       'action' => 'access']);
    Route::get(config('pulsar.name') . '/booking/products/prefix/create/{offset}',                    ['as' => 'createBookingProductPrefix',             'uses' => 'Syscover\Booking\Controllers\ProductPrefixController@createRecord',               'resource' => 'booking-product-prefix',       'action' => 'create']);
    Route::post(config('pulsar.name') . '/booking/products/prefix/store/{offset}',                    ['as' => 'storeBookingProductPrefix',              'uses' => 'Syscover\Booking\Controllers\ProductPrefixController@storeRecord',                'resource' => 'booking-product-prefix',       'action' => 'create']);
    Route::get(config('pulsar.name') . '/booking/products/prefix/{id}/edit/{offset}',                 ['as' => 'editBookingProductPrefix',               'uses' => 'Syscover\Booking\Controllers\ProductPrefixController@editRecord',                 'resource' => 'booking-product-prefix',       'action' => 'access']);
    Route::put(config('pulsar.name') . '/booking/products/prefix/update/{id}/{offset}',               ['as' => 'updateBookingProductPrefix',             'uses' => 'Syscover\Booking\Controllers\ProductPrefixController@updateRecord',               'resource' => 'booking-product-prefix',       'action' => 'edit']);
    Route::get(config('pulsar.name') . '/booking/products/prefix/delete/{id}/{offset}',               ['as' => 'deleteBookingProductPrefix',             'uses' => 'Syscover\Booking\Controllers\ProductPrefixController@deleteRecord',               'resource' => 'booking-product-prefix',       'action' => 'delete']);
    Route::delete(config('pulsar.name') . '/booking/products/prefix/delete/select/records',           ['as' => 'deleteSelectBookingProductPrefix',       'uses' => 'Syscover\Booking\Controllers\ProductPrefixController@deleteRecordsSelect',        'resource' => 'booking-product-prefix',       'action' => 'delete']);


    /*
    |--------------------------------------------------------------------------
    | CAMPAIGNS
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.name') . '/booking/campaigns/{offset?}',                          ['as' => 'bookingCampaign',                   'uses' => 'Syscover\Booking\Controllers\CampaignController@index',                      'resource' => 'booking-campaign',       'action' => 'access']);
    Route::any(config('pulsar.name') . '/booking/campaigns/json/data',                          ['as' => 'jsonDataBookingCampaign',           'uses' => 'Syscover\Booking\Controllers\CampaignController@jsonData',                   'resource' => 'booking-campaign',       'action' => 'access']);
    Route::get(config('pulsar.name') . '/booking/campaigns/create/{offset}',                    ['as' => 'createBookingCampaign',             'uses' => 'Syscover\Booking\Controllers\CampaignController@createRecord',               'resource' => 'booking-campaign',       'action' => 'create']);
    Route::post(config('pulsar.name') . '/booking/campaigns/store/{offset}',                    ['as' => 'storeBookingCampaign',              'uses' => 'Syscover\Booking\Controllers\CampaignController@storeRecord',                'resource' => 'booking-campaign',       'action' => 'create']);
    Route::get(config('pulsar.name') . '/booking/campaigns/{id}/edit/{offset}',                 ['as' => 'editBookingCampaign',               'uses' => 'Syscover\Booking\Controllers\CampaignController@editRecord',                 'resource' => 'booking-campaign',       'action' => 'access']);
    Route::put(config('pulsar.name') . '/booking/campaigns/update/{id}/{offset}',               ['as' => 'updateBookingCampaign',             'uses' => 'Syscover\Booking\Controllers\CampaignController@updateRecord',               'resource' => 'booking-campaign',       'action' => 'edit']);
    Route::get(config('pulsar.name') . '/booking/campaigns/delete/{id}/{offset}',               ['as' => 'deleteBookingCampaign',             'uses' => 'Syscover\Booking\Controllers\CampaignController@deleteRecord',               'resource' => 'booking-campaign',       'action' => 'delete']);
    Route::delete(config('pulsar.name') . '/booking/campaigns/delete/select/records',           ['as' => 'deleteSelectBookingCampaign',       'uses' => 'Syscover\Booking\Controllers\CampaignController@deleteRecordsSelect',        'resource' => 'booking-campaign',       'action' => 'delete']);

    /*
    |--------------------------------------------------------------------------
    | PLACES
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.name') . '/booking/places/{offset?}',                          ['as' => 'bookingPlace',                   'uses' => 'Syscover\Booking\Controllers\PlaceController@index',                      'resource' => 'booking-place',       'action' => 'access']);
    Route::any(config('pulsar.name') . '/booking/places/json/data',                          ['as' => 'jsonDataBookingPlace',           'uses' => 'Syscover\Booking\Controllers\PlaceController@jsonData',                   'resource' => 'booking-place',       'action' => 'access']);
    Route::get(config('pulsar.name') . '/booking/places/create/{offset}',                    ['as' => 'createBookingPlace',             'uses' => 'Syscover\Booking\Controllers\PlaceController@createRecord',               'resource' => 'booking-place',       'action' => 'create']);
    Route::post(config('pulsar.name') . '/booking/places/store/{offset}',                    ['as' => 'storeBookingPlace',              'uses' => 'Syscover\Booking\Controllers\PlaceController@storeRecord',                'resource' => 'booking-place',       'action' => 'create']);
    Route::get(config('pulsar.name') . '/booking/places/{id}/edit/{offset}',                 ['as' => 'editBookingPlace',               'uses' => 'Syscover\Booking\Controllers\PlaceController@editRecord',                 'resource' => 'booking-place',       'action' => 'access']);
    Route::put(config('pulsar.name') . '/booking/places/update/{id}/{offset}',               ['as' => 'updateBookingPlace',             'uses' => 'Syscover\Booking\Controllers\PlaceController@updateRecord',               'resource' => 'booking-place',       'action' => 'edit']);
    Route::get(config('pulsar.name') . '/booking/places/delete/{id}/{offset}',               ['as' => 'deleteBookingPlace',             'uses' => 'Syscover\Booking\Controllers\PlaceController@deleteRecord',               'resource' => 'booking-place',       'action' => 'delete']);
    Route::delete(config('pulsar.name') . '/booking/places/delete/select/records',           ['as' => 'deleteSelectBookingPlace',       'uses' => 'Syscover\Booking\Controllers\PlaceController@deleteRecordsSelect',        'resource' => 'booking-place',       'action' => 'delete']);

    /*
    |--------------------------------------------------------------------------
    | PREFERENCES
    |--------------------------------------------------------------------------
    */
    Route::any(config('pulsar.name') . '/booking/preferences',                               ['as' => 'bookingPreference',               'uses' => 'Syscover\Booking\Controllers\PreferenceController@index',             'resource' => 'booking-preference',     'action' => 'access']);
    Route::put(config('pulsar.name') . '/booking/preferences/update',                        ['as' => 'updateBookingPreference',         'uses' => 'Syscover\Booking\Controllers\PreferenceController@updateRecord',      'resource' => 'booking-preference',     'action' => 'edit']);
});
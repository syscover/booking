<?php

use Illuminate\Database\Seeder;
use Syscover\Pulsar\Models\Resource;

class BookingResourceTableSeeder extends Seeder {

    public function run()
    {
        Resource::insert([
            ['id_007' => 'booking',                 'name_007' => 'Booking Package',    'package_id_007' => '11'],
            ['id_007' => 'booking-preference',      'name_007' => 'Preferences',        'package_id_007' => '11'],
            ['id_007' => 'booking-voucher',         'name_007' => 'Vouchers',           'package_id_007' => '11'],
            ['id_007' => 'booking-booking',         'name_007' => 'Bookings',           'package_id_007' => '11'],
            ['id_007' => 'booking-booking-draft',   'name_007' => 'Bookings draft',     'package_id_007' => '11'],
            ['id_007' => 'booking-master-tables',   'name_007' => 'Master tables',      'package_id_007' => '11'],
            ['id_007' => 'booking-campaign',        'name_007' => 'Campaigns',          'package_id_007' => '11'],
            ['id_007' => 'booking-place',           'name_007' => 'Places',             'package_id_007' => '11'],
            ['id_007' => 'booking-family',          'name_007' => 'Families',           'package_id_007' => '11'],
            ['id_007' => 'booking-product-prefix',  'name_007' => 'Product prefix',     'package_id_007' => '11'],
        ]);
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="BookingResourceTableSeeder"
 */
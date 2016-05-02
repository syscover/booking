<?php

use Illuminate\Database\Seeder;
use Syscover\Pulsar\Models\Resource;

class BookingResourceTableSeeder extends Seeder {

    public function run()
    {
        Resource::insert([
            ['id_007' => 'booking',             'name_007' => 'Booking Package',    'package_007' => '11'],
            ['id_007' => 'booking-place',       'name_007' => 'Places',             'package_007' => '11'],
            ['id_007' => 'booking-campaign',    'name_007' => 'Campaigns',          'package_007' => '11'],
            ['id_007' => 'booking-voucher',     'name_007' => 'Vouchers',           'package_007' => '11'],
            ['id_007' => 'booking-family',      'name_007' => 'Families',           'package_007' => '11'],
            ['id_007' => 'booking-booking',     'name_007' => 'Bookings',           'package_007' => '11'],
        ]);
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="BookingResourceTableSeeder"
 */
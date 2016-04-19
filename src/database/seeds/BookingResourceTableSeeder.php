<?php

use Illuminate\Database\Seeder;
use Syscover\Pulsar\Models\Resource;

class BookingResourceTableSeeder extends Seeder {

    public function run()
    {
        Resource::insert([
            ['id_007' => 'booking',             'name_007' => 'Booking Package',    'package_007' => '11'],
            ['id_007' => 'booking-voucher',     'name_007' => 'Vouchers',           'package_007' => '11']
        ]);
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="BookingResourceTableSeeder"
 */
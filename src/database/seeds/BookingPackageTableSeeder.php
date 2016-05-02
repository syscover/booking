<?php

use Illuminate\Database\Seeder;
use Syscover\Pulsar\Models\Package;

class BookingPackageTableSeeder extends Seeder
{
    public function run()
    {
        Package::insert([
            ['id_012' => '11', 'name_012' => 'Booking Package', 'folder_012' => 'booking', 'sorting_012' => 11, 'active_012' => false]
        ]);
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="BookingPackageTableSeeder"
 */
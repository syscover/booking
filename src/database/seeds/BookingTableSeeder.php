<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class BookingTableSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();

        $this->call(BookingPackageTableSeeder::class);
        $this->call(BookingResourceTableSeeder::class);
        $this->call(BookingCronjobTableSeeder::class);

        Model::reguard();
    }
}

/*
 * Command to run:
 * php artisan db:seed --class="BookingTableSeeder"
 */
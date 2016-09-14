<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Syscover\Pulsar\Libraries\DBLibrary;

class BookingUpdateV4 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasColumn('011_225_booking', 'n_rooms_225'))
        {
            Schema::table('011_225_booking', function ($table) {
                $table->smallInteger('n_rooms_225')->unsigned()->nullable();
            });
        }

        if(Schema::hasColumn('011_225_booking', 'room_description_225'))
        {
            Schema::table('011_225_booking', function ($table) {
                $table->renameColumn('room_description_225', 'object_description_225');
            });
        }

        if(Schema::hasColumn('011_225_booking', 'n_adult_225'))
        {
            Schema::table('011_225_booking', function ($table) {
                $table->renameColumn('n_adult_225', 'n_adults_225');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){}
}
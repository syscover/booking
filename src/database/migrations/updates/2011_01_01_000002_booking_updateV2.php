<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Syscover\Pulsar\Libraries\DBLibrary;

class BookingUpdateV2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // rename columns
        // model_220
        DBLibrary::renameColumn('011_220_place', 'model_220', 'model_id_220', 'SMALLINT', 5, true, false);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){}
}
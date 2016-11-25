<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BookingUpdateV5 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasColumn('011_225_booking', 'object_name_225'))
        {
            Schema::table('011_225_booking', function (Blueprint $table) {
                $table->string('object_name_225')->after('object_id_225');
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
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BookingUpdateV7 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasColumn('011_225_booking', 'status_text_225'))
        {
            Schema::table('011_225_booking', function (Blueprint $table) {
                $table->string('status_text_225')->after('status_225');
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
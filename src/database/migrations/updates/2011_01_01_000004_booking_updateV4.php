<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BookingUpdateV4 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasColumn('011_225_booking', 'tax_percentage_225'))
        {
            Schema::table('011_225_booking', function (Blueprint $table) {
                $table->decimal('tax_percentage_225', 10, 2)->after('total_amount_225');
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
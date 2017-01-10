<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BookingUpdateV8 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasColumn('011_225_booking', 'partner_direct_payment_amount_225'))
        {
            Schema::table('011_225_booking', function (Blueprint $table) {
                $table->decimal('partner_direct_payment_amount_225', 10, 2)->after('vouchers_cost_amount_225');    // amount must paid customer in business
            });
        }

        if(! Schema::hasColumn('011_225_booking', 'place_direct_payment_amount_225'))
        {
            Schema::table('011_225_booking', function (Blueprint $table) {
                $table->renameColumn('direct_payment_amount_225', 'place_direct_payment_amount_225');
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
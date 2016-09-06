<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Syscover\Pulsar\Libraries\DBLibrary;

class BookingUpdateV3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(Schema::hasColumn('011_226_voucher', 'paid_226'))
        {
            Schema::table('011_226_voucher', function ($table) {
                $table->boolean('paid_226')->default(false)->change();
            });
        }

        if(! Schema::hasColumn('011_225_booking', 'customer_name_225'))
        {
            Schema::table('011_225_booking', function ($table) {
                $table->string('customer_name_225')->after('customer_id_225');
            });
        }

        if(! Schema::hasColumn('011_224_booking_draft', 'customer_name_224'))
        {
            Schema::table('011_224_booking_draft', function ($table) {
                $table->string('customer_name_224')->after('customer_id_224');
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
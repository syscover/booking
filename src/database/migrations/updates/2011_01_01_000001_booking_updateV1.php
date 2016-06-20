<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BookingUpdateV1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(! Schema::hasColumn('011_226_voucher', 'has_used_226'))
        {
            Schema::table('011_226_voucher', function (Blueprint $table) {
                $table->boolean('has_used_226')->default(false)->after('active_226');
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
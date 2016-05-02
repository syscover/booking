<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BookingCreateTableCampaign extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('011_221_campaign', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
            $table->increments('id_221')->unsigned();
            $table->string('name_221');
			$table->boolena('active_221');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('011_221_campaign');
	}

}

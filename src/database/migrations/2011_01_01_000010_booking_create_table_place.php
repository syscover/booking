<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BookingCreateTablePlace extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('011_220_place', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
            $table->increments('id_220')->unsigned();
            $table->string('name_220');
			$table->string('model_220');			// model to do queries
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('011_220_campaign');
	}

}

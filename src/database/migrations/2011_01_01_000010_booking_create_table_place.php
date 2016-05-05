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
		// Types of places that can be reserved
		if(! Schema::hasTable('011_220_place'))
		{
			Schema::create('011_220_place', function (Blueprint $table) {
				$table->engine = 'InnoDB';
				$table->increments('id_220')->unsigned();
				$table->smallInteger('model_220')->unsigned();	// model to do queries
				$table->string('name_220');
			});
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		if(Schema::hasTable('011_220_place'))
		{
			Schema::drop('011_220_place');
		}
	}
}
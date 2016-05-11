<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BookingCreateTableFamily extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(! Schema::hasTable('011_223_family')) 
		{
			Schema::create('011_223_family', function (Blueprint $table) {
				$table->engine = 'InnoDB';

				$table->increments('id_223')->unsigned();
				$table->string('name_223');
				$table->string('mail_template_223');
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
		if(Schema::hasTable('011_223_family')) 
		{
			Schema::drop('011_223_family');
		}
	}
}
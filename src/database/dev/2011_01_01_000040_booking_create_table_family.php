<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFamilyTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('011_223_family', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
            $table->increments('id_223')->unsigned();
            $table->string('name_223');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('011_223_family');
	}

}

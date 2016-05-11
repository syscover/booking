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
		if(! Schema::hasTable('011_224_family')) 
		{
			Schema::create('011_224_family', function (Blueprint $table) {
				$table->engine = 'InnoDB';
				$table->primary('id_224')->unsigned();
				$table->string('name_224');
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
		if(Schema::hasTable('011_224_family')) 
		{
			Schema::drop('011_224_family');
		}
	}
}
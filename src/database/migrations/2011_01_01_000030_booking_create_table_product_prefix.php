<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BookingCreateTableProductPrefix extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(! Schema::hasTable('011_222_product_prefix'))
		{
			Schema::create('011_222_product_prefix', function (Blueprint $table) {
				$table->engine = 'InnoDB';

				$table->integer('product_id_222')->unsigned();
				$table->string('prefix_222');

				$table->primary('product_id_222', 'pk01_011_222_product_prefix');
				$table->foreign('product_id_222', 'fk01_011_222_product_prefix')->references('id_111')->on('012_111_product')
					->onDelete('cascade')->onUpdate('cascade');
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
		if(Schema::hasTable('011_222_product_prefix'))
		{
			Schema::drop('011_222_product_prefix');
		}
	}
}
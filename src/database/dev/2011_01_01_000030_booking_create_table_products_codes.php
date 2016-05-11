<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BookingCreateTableVoucher extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(! Schema::hasTable('011_222_products_codes')) 
		{
			Schema::create('011_222_products_codes', function (Blueprint $table) {
				$table->engine = 'InnoDB';

				$table->integer('product_id_222')->unsigned();
				$table->string('prefix_code_222');

				$table->foreign('product_id_222', 'fk01_011_222_products_codes')->references('id_111')->on('012_111_product')
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
		if(Schema::hasTable('011_222_products_codes')) 
		{
			Schema::drop('011_222_products_codes');
		}
	}
}
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
		Schema::create('011_220_voucher', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
            $table->increments('id_220')->unsigned();
			$table->string('code_220')->nullable();

			$table->integer('date_220')->unsigned();
			$table->string('data_text_220');

			$table->integer('customer_220')->nullable()->unsigned(); // customer that is related this voucher
			$table->integer('product_220')->nullable()->unsigned(); // product that is related this voucher

			$table->string('name_220')->nullable();
			$table->text('description_220')->nullable();

			$table->decimal('cost_220', 10, 2)->nullable(); // hotel price
			$table->decimal('price_220', 10, 2)->nullable(); // public price

			$table->integer('used_date_220')->unsigned()->nullable(); // used date
			$table->string('used_date_text_220')->nullable();

			$table->integer('expire_date_220')->unsigned()->nullable();
			$table->string('expire_date_text_220')->nullable();

			$table->boolean('active_220');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('011_220_voucher');
	}
}
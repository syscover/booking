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
		Schema::create('011_222_voucher', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';

            $table->increments('id_222')->unsigned();

			$table->integer('date_222')->unsigned();
			$table->string('date_text_222');

			// ID de campaña
			$table->integer('campaign_id_222')->nullable()->unsigned();
			
			$table->string('code_222')->nullable();
			$table->integer('product_id_222')->nullable()->unsigned(); // product that is related this voucher

			$table->string('name_222')->nullable(); // name of voucher
			$table->text('description_222')->nullable(); // description of voucher
			
			$table->integer('customer_id_222')->nullable()->unsigned(); // customer who buy the voucher
			$table->string('invoice_222')->nullable(); // invoice number where this voucher has been invoiced
			
			$table->decimal('price_222', 10, 2)->nullable(); // public price
			$table->decimal('cost_222', 10, 2)->nullable(); // hotel price

			$table->integer('expire_date_222')->unsigned()->nullable();
			$table->string('expire_date_text_222')->nullable();

			// campos ha rellenar durante la reserva
			$table->integer('used_date_222')->unsigned()->nullable(); // used date
			$table->string('used_date_text_222')->nullable();

			$table->integer('place_type_id_223')->unsigned(); // hotel, bodega, spa...
			$table->integer('place_id_223')->unsigned(); // ID del hotel, bodega, spa...
			
			$table->boolean('active_222');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('011_222_voucher');
	}
}
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(! Schema::hasTable('011_225_booking')) 
		{
			Schema::create('011_225_booking', function (Blueprint $table) {
				$table->engine = 'InnoDB';
				$table->increments('id_225')->unsigned();

				// customer making the reservation
				$table->integer('customer_id_225')->unsigned();

				$table->integer('place_type_id_225')->unsigned(); // hotel, bodega, spa...
				$table->integer('place_id_225')->unsigned(); // ID del hotel, bodega, spa...
				$table->string('room_description_225')->nullable(); // room name of booking

				$table->integer('check_in_date_225')->unsigned()->nullable();
				$table->string('check_in_date_text_225')->nullable();

				$table->integer('check_out_date_225')->unsigned()->nullable();
				$table->string('check_out_date_text_225')->nullable();

				$table->smallInteger('n_adult_225')->unsigned()->nullable();
				$table->smallInteger('n_children_225')->unsigned()->nullable();
				$table->smallInteger('temporary_bed_225')->unsigned()->nullable();
				$table->boolean('breakfast_225'); // breakfast include?

				// importe pagado en vouchers
				$table->decimal('vouchers_amount_225', 10, 2)->nullable();

				// importe a pagar al hotel, spa o bodega
				$table->decimal('place_amount_225', 10, 2)->nullable();

				// importe importe neto
				$table->decimal('total_amount_225', 10, 2)->nullable();

				// dia de pago al hotel, spa o bodega
				$table->integer('place_payout_date_225')->unsigned()->nullable();
				$table->string('place_payout_date_text_225')->nullable();

				$table->text('observations_225')->nullable();
				$table->text('place_observations_225')->nullable();
				$table->text('customer_observations_225')->nullable();
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
		if(Schema::hasTable('011_225_booking')) 
		{
			Schema::drop('011_225_booking');
		}
	}

}
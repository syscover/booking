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
		Schema::create('011_224_booking', function(Blueprint $table)
		{
            $table->engine = 'InnoDB';
            $table->increments('id_224')->unsigned();

			// customer making the reservation
			$table->integer('customer_id_224')->unsigned();
			
			$table->integer('place_type_id_224')->unsigned(); // hotel, bodega, spa...
			$table->integer('place_id_224')->unsigned(); // ID del hotel, bodega, spa...
			$table->string('room_description_224')->nullable(); // room name of booking

			$table->integer('check_in_date_224')->unsigned()->nullable();
			$table->string('check_in_date_text_224')->nullable();

			$table->integer('check_out_date_224')->unsigned()->nullable();
			$table->string('check_out_date_text_224')->nullable();

			$table->smallInteger('n_adult_224')->unsigned()->nullable();
			$table->smallInteger('n_children_224')->unsigned()->nullable();
			$table->smallInteger('temporary_bed_224')->unsigned()->nullable();
			$table->boolean('breakfast_224'); // breakfast include?

			// importe pagado en vouchers
			$table->decimal('vouchers_amount_224', 10, 2)->nullable();

			// importe a pagar al hotel, spa o bodega
			$table->decimal('place_amount_224', 10, 2)->nullable();

			// importe importe neto
			$table->decimal('total_amount_224', 10, 2)->nullable();

			// dia de pago al hotel, spa o bodega
			$table->integer('place_payout_date_224')->unsigned()->nullable();
			$table->string('place_payout_date_text_224')->nullable();

			$table->text('observations_224')->nullable();
			$table->text('place_observations_224')->nullable();
			$table->text('customer_observations_224')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('011_224_booking');
	}

}

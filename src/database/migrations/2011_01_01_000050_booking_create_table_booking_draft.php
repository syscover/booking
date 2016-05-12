<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BookingCreateTableBookingDraft extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(! Schema::hasTable('011_224_booking_draft'))
		{
			Schema::create('011_224_booking_draft', function (Blueprint $table) {
				$table->engine = 'InnoDB';
				
				$table->increments('id_224')->unsigned();
				$table->integer('date_224')->unsigned();
				$table->string('date_text_224')->nullable();

				// customer making the reservation
				$table->integer('customer_id_224')->unsigned();
				
				$table->integer('place_id_224')->unsigned(); // hotel, bodega, spa... foreign key from 011_220_place
				$table->integer('object_id_224')->nullable()->unsigned(); // ID del hotel, bodega, spa...
				$table->string('room_description_224')->nullable(); // room name of booking

				$table->integer('check_in_date_224')->unsigned()->nullable();
				$table->string('check_in_date_text_224')->nullable();

				$table->integer('check_out_date_224')->unsigned()->nullable();
				$table->string('check_out_date_text_224')->nullable();

				$table->smallInteger('n_adult_224')->unsigned()->nullable();
				$table->smallInteger('n_children_224')->unsigned()->nullable();
				$table->smallInteger('temporary_bed_224')->unsigned()->nullable();
				$table->boolean('breakfast_224'); // breakfast include? por defecto SI

				$table->decimal('vouchers_cost_amount_224', 10, 2); // sum of the total amount paid in vouchers
				
				$table->decimal('customer_place_amount_224', 10, 2); // amount payable to the hotel for the customer

				// importe  neto, que es la suma de los campos vouchers_cost_amount_224 + customer_place_amount_224
				$table->decimal('total_amount_224', 10, 2);

				// commissions
				$table->tinyInteger('commission_percentage_224')->unsigned();
				$table->decimal('amount_on_commission_224', 10, 2); // quantity on which commission
				$table->decimal('commission_amount_224', 10, 2); // commission

				$table->text('observations_224')->nullable();
				$table->text('place_observations_224')->nullable();
				$table->text('customer_observations_224')->nullable();

				$table->foreign('customer_id_224', 'fk01_011_224_draft_booking')->references('id_301')->on('009_301_customer')
					->onDelete('restrict')->onUpdate('cascade');
				$table->foreign('place_id_224', 'fk02_011_224_draft_booking')->references('id_220')->on('011_220_place')
					->onDelete('restrict')->onUpdate('cascade');
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
		if(Schema::hasTable('011_224_booking_draft')) 
		{
			Schema::drop('011_224_booking_draft');
		}
	}

}
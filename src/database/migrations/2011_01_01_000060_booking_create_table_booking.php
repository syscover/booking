<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BookingCreateTableBooking extends Migration {

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
				$table->integer('date_225')->unsigned();
				$table->string('date_text_225')->nullable();
				
				$table->tinyInteger('status_225')->unsigned(); // status: cancel or confirmed

				// customer making the reservation
				$table->integer('customer_id_225')->unsigned();
				
				$table->integer('place_id_225')->unsigned(); // hotel, bodega, spa... foreign key from 011_220_place
				$table->integer('object_id_225')->unsigned(); // ID del hotel, bodega, spa...
				$table->string('room_description_225')->nullable(); // room name of booking

				$table->integer('check_in_date_225')->unsigned();
				$table->string('check_in_date_text_225');

				$table->integer('check_out_date_225')->unsigned();
				$table->string('check_out_date_text_225');

				$table->smallInteger('n_adult_225')->unsigned()->nullable();
				$table->smallInteger('n_children_225')->unsigned()->nullable();
				$table->smallInteger('temporary_bed_225')->unsigned()->nullable();
				$table->boolean('breakfast_225'); // breakfast include? por defecto SI
				
				$table->decimal('vouchers_cost_amount_225', 10, 2); // sum of the total amount paid in vouchers
				
				$table->decimal('customer_place_amount_225', 10, 2); // amount payable to the hotel for the customer

				// importe  neto, que es la suma de los campos vouchers_cost_amount_225 + customer_place_amount_225
				$table->decimal('total_amount_225', 10, 2);

				// comisiones
				$table->integer('commission_percentage_225');
				$table->decimal('amount_on_commission_225', 10, 2); // quantity on which commission
				$table->decimal('commission_amount_225', 10, 2); // commission

				$table->text('observations_225')->nullable();
				$table->text('place_observations_225')->nullable();
				$table->text('customer_observations_225')->nullable();

				$table->foreign('customer_id_225', 'fk01_011_225_booking')->references('id_301')->on('009_301_customer')
					->onDelete('restrict')->onUpdate('cascade');
				$table->foreign('place_id_225', 'fk02_011_225_booking')->references('id_220')->on('011_220_place')
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
		if(Schema::hasTable('011_225_booking')) 
		{
			Schema::drop('011_225_booking');
		}
	}

}
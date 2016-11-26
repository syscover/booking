<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BookingCreateTableBooking extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		if(! Schema::hasTable('011_225_booking'))
		{
			Schema::create('011_225_booking', function (Blueprint $table) {
				$table->engine = 'InnoDB';

				$table->increments('id_225')->unsigned();
				$table->integer('date_225')->unsigned();
				$table->string('date_text_225')->nullable();
				
				$table->tinyInteger('status_225')->unsigned();          // status: cancel or confirmed
                $table->string('status_text_225');                      // register status text to do search

				// customer making the reservation
				$table->integer('customer_id_225')->unsigned();
                $table->string('customer_name_225');
                $table->text('customer_observations_225')->nullable();

                // places
                $table->integer('place_id_225')->unsigned();            // hotel, bodega, spa... foreign key from 011_220_place
                $table->integer('object_id_225')->unsigned();           // ID del hotel, bodega, spa...
                $table->string('object_name_225');                      // name of hotel, bodega, spa...
                $table->string('object_description_225')->nullable();   // room name of booking or treatment or testing
                $table->text('place_observations_225')->nullable();     // observations for the establishment

                // dates
                $table->integer('check_in_date_225')->unsigned();
                $table->string('check_in_date_text_225');

                $table->integer('check_out_date_225')->unsigned();
                $table->string('check_out_date_text_225');

                $table->smallInteger('nights_225')->unsigned()->nullable();

                // people
                $table->smallInteger('n_adults_225')->unsigned()->nullable();
                $table->smallInteger('n_children_225')->unsigned()->nullable();

                // booking to hotel room
                $table->smallInteger('n_rooms_225')->unsigned()->nullable();
                $table->smallInteger('temporary_beds_225')->unsigned()->nullable();
				$table->tinyInteger('breakfast_225')->unsigned()->nullable();

				// amounts
				$table->decimal('vouchers_paid_amount_225', 10, 2);     // sum of total amount paid in vouchers
				$table->decimal('vouchers_cost_amount_225', 10, 2);     // sum of total amount cost in vouchers
				$table->decimal('direct_payment_amount_225', 10, 2);    // amount must paid customer in site
				$table->decimal('total_amount_225', 10, 2);				// total amount, vouchers amount plus customer payment
                $table->decimal('tax_percentage_225', 10, 2);			// tax that contain total amount

				// commissions
				$table->tinyInteger('commission_percentage_225')->unsigned();
				$table->decimal('commission_calculation_225', 10, 2);  	// quantity on which commission
				$table->decimal('commission_amount_225', 10, 2);        // commission

				$table->text('observations_225')->nullable();

                $table->text('data_225')->nullable();

				$table->foreign('customer_id_225', 'fk01_011_225_booking')
					->references('id_301')
					->on('009_301_customer')
					->onDelete('restrict')
					->onUpdate('cascade');
				$table->foreign('place_id_225', 'fk02_011_225_booking')
					->references('id_220')
					->on('011_220_place')
					->onDelete('restrict')
					->onUpdate('cascade');
			});
		}
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		if(Schema::hasTable('011_225_booking')) {
			Schema::drop('011_225_booking');
		}
	}
}
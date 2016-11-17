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

                $table->tinyInteger('status_224')->unsigned()->nullable();          // status: cancel or confirmed

                // customer making the reservation
                $table->integer('customer_id_224')->unsigned();
                $table->string('customer_name_224');
                $table->text('customer_observations_224')->nullable();

                // places
                $table->integer('place_id_224')->unsigned()->nullable();            // hotel, bodega, spa... foreign key from 011_220_place
                $table->integer('object_id_224')->unsigned()->nullable();           // ID del hotel, bodega, spa...
                $table->string('object_description_224')->nullable();               // room name of booking or treatment or testing
                $table->text('place_observations_224')->nullable();                 // observations for the establishment

                // dates
                $table->integer('check_in_date_224')->unsigned()->nullable();
                $table->string('check_in_date_text_224')->nullable();

                $table->integer('check_out_date_224')->unsigned()->nullable();
                $table->string('check_out_date_text_224')->nullable();

                $table->smallInteger('nights_224')->unsigned()->nullable();

                // people
                $table->smallInteger('n_adults_224')->unsigned()->nullable();
                $table->smallInteger('n_children_224')->unsigned()->nullable();

                // booking to hotel room
                $table->smallInteger('n_rooms_224')->unsigned()->nullable();
                $table->smallInteger('temporary_beds_224')->unsigned()->nullable();
                $table->tinyInteger('breakfast_224')->unsigned()->nullable();

                // amounts
                $table->decimal('vouchers_paid_amount_224', 10, 2)->nullable();     // sum of total amount paid in vouchers
                $table->decimal('vouchers_cost_amount_224', 10, 2)->nullable();     // sum of total amount cost in vouchers
                $table->decimal('direct_payment_amount_224', 10, 2)->nullable();    // amount must paid customer in site
                $table->decimal('total_amount_224', 10, 2)->nullable();				// total amount, vouchers amount plus customer payment
                $table->decimal('tax_percentage_224', 10, 2)->nullable();			// tax that contain total amount

                // commissions
                $table->tinyInteger('commission_percentage_224')->unsigned()->nullable();
                $table->decimal('commission_calculation_224', 10, 2)->nullable();  	// quantity on which commission
                $table->decimal('commission_amount_224', 10, 2)->nullable();        // commission

                $table->text('observations_224')->nullable();

				$table->foreign('customer_id_224', 'fk01_011_224_draft_booking')
					->references('id_301')
					->on('009_301_customer')
					->onDelete('restrict')
					->onUpdate('cascade');
				$table->foreign('place_id_224', 'fk02_011_224_draft_booking')
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
	public function down()
	{
		if(Schema::hasTable('011_224_booking_draft')) 
		{
			Schema::drop('011_224_booking_draft');
		}
	}
}
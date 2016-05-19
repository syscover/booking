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
		if(! Schema::hasTable('011_226_voucher')) 
		{
			Schema::create('011_226_voucher', function (Blueprint $table) {
				$table->engine = 'InnoDB';

				$table->increments('id_226')->unsigned();
				$table->string('code_226');
				$table->string('code_prefix_226')->nullable(); //prefix voucher code

				$table->integer('booking_id_226')->nullable()->unsigned(); // booking where this voucher has been used

				$table->integer('date_226')->unsigned();
				$table->string('date_text_226');

				// campaign ID
				$table->integer('campaign_id_226')->unsigned();

				$table->integer('customer_id_226')->unsigned(); // customer who buy the voucher
				$table->string('bearer_226')->nullable(); // bearer of the voucher, should be nominative

				// invoice data number and customer invoiced
				$table->integer('invoice_id_226')->nullable()->unsigned();
				$table->string('invoice_code_226')->nullable();
				$table->integer('invoice_customer_id_226')->nullable()->unsigned();
				$table->string('invoice_customer_name_226')->nullable();

				$table->integer('product_id_226')->unsigned(); // product that is related this voucher

				$table->string('name_226')->nullable(); // name of voucher
				$table->text('description_226')->nullable(); // description of voucher

				$table->decimal('price_226', 10, 2); // price that is sold this voucher

				// sin están inactivos no tiene fecha de caducidad, la tendría cuando se activa
				$table->integer('expire_date_226')->unsigned()->nullable(); // el ultimo día del mes en curso  + 1 año
				$table->string('expire_date_text_226')->nullable();

				$table->boolean('active_226');

				// campos ha rellenar durante la reserva
				$table->integer('used_date_226')->unsigned()->nullable(); // used date
				$table->string('used_date_text_226')->nullable();

				$table->integer('place_id_226')->nullable()->unsigned(); // hotel, bodega, spa... foreign key from 011_220_place
				$table->integer('object_id_226')->nullable()->unsigned(); // ID del hotel, bodega, spa...

				$table->decimal('cost_226', 10, 2); // hotel price

				// field to check if voucher is paid
				$table->boolean('paid_226'); // hotel price
				$table->integer('place_payout_date_225')->unsigned()->nullable();
				$table->string('place_payout_date_text_225')->nullable();
				

				$table->foreign('campaign_id_226', 'fk01_011_226_voucher')->references('id_221')->on('011_221_campaign')
					->onDelete('restrict')->onUpdate('cascade');
				$table->foreign('product_id_226', 'fk02_011_226_voucher')->references('id_111')->on('012_111_product')
					->onDelete('restrict')->onUpdate('cascade');
				$table->foreign('customer_id_226', 'fk03_011_226_voucher')->references('id_301')->on('009_301_customer')
					->onDelete('restrict')->onUpdate('cascade');
				$table->foreign('place_id_226', 'fk04_011_226_voucher')->references('id_220')->on('011_220_place')
					->onDelete('restrict')->onUpdate('cascade');
				$table->foreign('booking_id_226', 'fk05_011_226_voucher')->references('id_225')->on('011_225_booking')
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
		if(Schema::hasTable('011_226_voucher')) 
		{
			Schema::drop('011_226_voucher');
		}
	}
}
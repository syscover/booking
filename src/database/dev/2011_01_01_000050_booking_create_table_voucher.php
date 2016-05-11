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
		if(! Schema::hasTable('011_224_voucher')) 
		{
			Schema::create('011_224_voucher', function (Blueprint $table) {
				$table->engine = 'InnoDB';

				$table->increments('id_224')->unsigned();

				$table->integer('date_224')->unsigned();
				$table->string('date_text_224');

				// ID de campaña
				$table->integer('campaign_id_224')->nullable()->unsigned();

				$table->integer('customer_id_224')->nullable()->unsigned(); // customer who buy the voucher
				$table->string('invoice_224')->nullable(); // invoice number where this voucher has been invoiced

				$table->integer('product_id_224')->nullable()->unsigned(); // product that is related this voucher
				$table->string('prefix_code_224')->nullable(); //prefix voucher code

				$table->string('name_224')->nullable(); // name of voucher
				$table->text('description_224')->nullable(); // description of voucher

				$table->decimal('price_224', 10, 2)->nullable(); // public price
				$table->decimal('cost_224', 10, 2)->nullable(); // hotel price

				$table->integer('expire_date_224')->unsigned()->nullable();
				$table->string('expire_date_text_224')->nullable();

				// campos ha rellenar durante la reserva
				$table->integer('used_date_224')->unsigned()->nullable(); // used date
				$table->string('used_date_text_224')->nullable();

				$table->integer('place_id_224')->unsigned(); // hotel, bodega, spa... foreign key from 011_220_place
				$table->integer('object_id_224')->unsigned(); // ID del hotel, bodega, spa...

				$table->boolean('active_224');

				$table->foreign('campaign_id_224', 'fk01_011_224_voucher')->references('id_221')->on('011_221_campaign')
					->onDelete('set null')->onUpdate('cascade');
				$table->foreign('product_id_224', 'fk02_011_224_voucher')->references('id_111')->on('012_111_product')
					->onDelete('set null')->onUpdate('cascade');
				$table->foreign('customer_id_224', 'fk03_011_224_voucher')->references('id_301')->on('009_301_customer')
					->onDelete('set null')->onUpdate('cascade');
				$table->foreign('place_id_224', 'fk04_011_224_voucher')->references('id_220')->on('011_220_place')
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
		if(Schema::hasTable('011_224_voucher')) 
		{
			Schema::drop('011_224_voucher');
		}
	}
}
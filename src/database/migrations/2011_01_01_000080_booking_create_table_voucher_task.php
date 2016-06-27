<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BookingCreateTableVoucherTask extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		if(! Schema::hasTable('011_227_voucher_task'))
		{
			Schema::create('011_227_voucher_task', function (Blueprint $table) {
				$table->engine = 'InnoDB';

				$table->increments('id_227')->unsigned();
				$table->integer('user_id_227')->unsigned();
				$table->integer('voucher_id_227')->nullable()->unsigned();
				$table->smallInteger('vouchers_to_create_227')->unsigned();
				$table->smallInteger('total_vouchers_227')->unsigned(); // n vouchers to create in total
				
				$table->foreign('voucher_id_227', 'fk01_011_227_voucher_task')
					->references('id_226')
					->on('011_226_voucher')
					->onDelete('cascade')
					->onUpdate('cascade');
				$table->foreign('user_id_227', 'fk02_011_227_voucher_task')
					->references('id_010')
					->on('001_010_user')
					->onDelete('cascade')
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
		if(Schema::hasTable('011_227_voucher_task'))
		{
			Schema::drop('011_227_voucher_task');
		}
	}
}
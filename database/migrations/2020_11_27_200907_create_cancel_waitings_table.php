<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCancelWaitingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cancel_waitings', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->dateTime('start');
			$table->string('name');
			$table->string('email');
			$table->string('tel');
			$table->integer('menu_id')->index('menu_id');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cancel_waitings');
	}

}

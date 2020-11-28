<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('rests', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('nailist_id')->index('nailist_id');
			$table->dateTime('start');
			$table->dateTime('end');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('rests');
	}

}

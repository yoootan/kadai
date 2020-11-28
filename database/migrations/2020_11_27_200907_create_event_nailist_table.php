<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEventNailistTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('event_nailist', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('event_id')->index('event_nailist_ibfk_2');
			$table->integer('nailist_id')->index('event_nailist_ibfk_1');
			$table->boolean('available')->default(1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('event_nailist');
	}

}

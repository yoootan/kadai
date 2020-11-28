<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateReservationEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reservation_events', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->dateTime('start');
			$table->integer('nailist_id')->nullable()->index('reservation_events_ibfk_2');
			$table->integer('menu_id')->index('reservation_events_ibfk_1');
			$table->string('name');
			$table->string('email');
			$table->string('tel');
			$table->string('note')->nullable();
			$table->integer('price')->nullable();
			$table->boolean('confirmed')->default(0);
			$table->boolean('delete_flg')->nullable()->default(0);
			$table->dateTime('create_at')->nullable();
			$table->dateTime('update_at')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('reservation_events');
	}

}

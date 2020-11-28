<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToReservationEventsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('reservation_events', function(Blueprint $table)
		{
			$table->foreign('menu_id', 'reservation_events_ibfk_1')->references('id')->on('menus')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('nailist_id', 'reservation_events_ibfk_2')->references('id')->on('nailists')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('reservation_events', function(Blueprint $table)
		{
			$table->dropForeign('reservation_events_ibfk_1');
			$table->dropForeign('reservation_events_ibfk_2');
		});
	}

}

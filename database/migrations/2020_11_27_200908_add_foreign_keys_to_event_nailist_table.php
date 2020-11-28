<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToEventNailistTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('event_nailist', function(Blueprint $table)
		{
			$table->foreign('nailist_id', 'event_nailist_ibfk_1')->references('id')->on('nailists')->onUpdate('CASCADE')->onDelete('CASCADE');
			$table->foreign('event_id', 'event_nailist_ibfk_2')->references('id')->on('events')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('event_nailist', function(Blueprint $table)
		{
			$table->dropForeign('event_nailist_ibfk_1');
			$table->dropForeign('event_nailist_ibfk_2');
		});
	}

}

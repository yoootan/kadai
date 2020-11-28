<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToShiftsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('shifts', function(Blueprint $table)
		{
			$table->foreign('nailist_id', 'shifts_ibfk_1')->references('id')->on('nailists')->onUpdate('CASCADE')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('shifts', function(Blueprint $table)
		{
			$table->dropForeign('shifts_ibfk_1');
		});
	}

}
